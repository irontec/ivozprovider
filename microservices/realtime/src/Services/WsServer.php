<?php

namespace Services;

use Model\RedisConf;
use Model\Subscriber;
use Feeder\AbstractCall;
use Psr\Log\LoggerInterface;
use Swoole\Coroutine;
use Swoole\Coroutine\Redis;
use Swoole\WebSocket\Server;
use Swoole\WebSocket\Frame;
use Swoole\Http\Request as HttpRequest;

class WsServer extends AbstractWsServer
{
    private $jwtToken;
    private $registrationChannelResolver;

    public function __construct(
        string $host,
        int $port,
        array $config,
        LoggerInterface $logger,
        JwtToken $jwtToken,
        RegistrationChannelResolver $registrationChannelResolver
    ) {
        $this->jwtToken = $jwtToken;
        $this->registrationChannelResolver = $registrationChannelResolver;

        parent::__construct(
            $host,
            $port,
            $config,
            $logger
        );
    }

    protected function onWorkerStart(
        Sentinel $sentinel,
        int $poolSize,
        int $db
    ) {
        $this->logger->info(
            'Init Redis Pool'
        );
        $this->redisPool = new RedisPool(
            $poolSize,
            $db,
            $this->logger
        );

        $this->logger->info(
            'Resolving redis master'
        );

        $redisMaster = $sentinel
            ->resolveMaster();

        $this
            ->subscribeToSentinel(
                $sentinel
            );

        $this->initRedisControlClients(
            $redisMaster
        );
    }

    protected function onOpen(
        Server $server,
        HttpRequest $req
    ) {
        $this->logger->debug(
            "Connection open: {$req->fd}"
        );

        $server->push(
            $req->fd,
            'Challenge'
        );
    }

    protected function onMessage(
        Server $server,
        Frame $frame
    ) {
        $fd = $frame->fd;
        $this->logger->debug(
            "<< Received message: {$frame->data}"
        );

        $data = json_decode(
            $frame->data,
            true
        );

        $isAuthValid = false;
        $tokenPayload = [];

        try {
            $tokenPayload = $this->jwtToken->getPayload(
                $data['auth'] ?? ''
            );

            $userInfo = sprintf(
                'User: %s (%s) on #' . $fd,
                $tokenPayload['username'],
                $tokenPayload['roles'][0]
            );

            $this->logger->info(
                $userInfo
            );

            $isAuthValid = true;
        } catch (\Exception $e) {
            $this->logger->info(
                $e->getMessage()
            );
        }

        $registerChannel = null;
        try {
            $isRegisterValid =
                $data
                && isset($data['register']);

            if (!$isRegisterValid) {
                throw new \Exception(
                    'Register channel not found in payload'
                );
            }

            $registerChannel = $this
                ->registrationChannelResolver
                ->criteriaToString(
                    $tokenPayload,
                    $data['register']
                );
        } catch (\Exception $e) {
            $this->logger->info(
                $e->getMessage()
            );
        }

        if ($isAuthValid && $registerChannel) {
            $this->sendCurrentStateAndUpdates(
                $server,
                $fd,
                $registerChannel
            );
        } else {
            $server->push(
                $frame->fd,
                'Challenge'
            );
        }
    }

    protected function onClose(Server $server, int $fd)
    {
        $this->logger->info(
            'Connection closed: #' . $fd
        );

        $subscriber = $this->subscribers[$fd] ?? null;
        if (!$subscriber) {
            $this->logger->info(
                'Unknown subscriber #' . $fd
            );

            return;
        }

        $redisClient = $this
            ->redisPool
            ->forcedGet();

        $redisClient
            ->publish(
                Subscriber::UNSUBSCRIBE_CHANNEL,
                $subscriber->getFd()
            );

        $redisClient->close();
    }

    ///////////////////////////////////////////
    /// Worker
    ///////////////////////////////////////////
    private function subscribeToSentinel(Sentinel $sentinel)
    {
        Coroutine::create(function () use ($sentinel) {

            $sentinel->subscribe();

            //We don't expect any message from sentinel unless redis master goes down
            $sentinel
                ->getChannel()
                ->pop();

            $this->logger->error(
                "Sentinel shutdown"
            );
            $this->shutdown();
            Coroutine::sleep(1);

            exit;
        });
    }

    private function initRedisControlClients(RedisConf $redisMaster)
    {
        $messageChannel = new Coroutine\Channel();

        Coroutine::create(function () use ($redisMaster, $messageChannel) {
            $this
                ->redisPool
                ->connect(
                    $redisMaster->getHost(),
                    $redisMaster->getPort()
                );

            $this->controlRedisSubscriber = $this
                ->redisPool
                ->get();

            $controlRedisSubscriber = $this->controlRedisSubscriber;

            $controlRedisSubscriber
                ->pSubscribe([
                    'trunks:*',
                    'users:*',
                ]);

            while ($msg = $controlRedisSubscriber->recv()) {
                $messageChannel->push($msg);
            }
        });

        Coroutine::create(function () use ($messageChannel) {

            $this->controlRedisClient = $this
                ->redisPool
                ->get();

            while ($msg = $messageChannel->pop()) {
                $this->updateCurrentCallsStatus(
                    $msg
                );
            }
        });
    }

    private function updateCurrentCallsStatus(array $msg)
    {
        list($type, $mask, $channel) = $msg;
        if ($type !== 'pmessage') {
            return;
        }

        $payload = json_decode($msg[3], true);
        $event = $payload['Event'];

        if ($event === AbstractCall::HANG_UP) {
            $this->logger->info(
                "[DEL] " . $channel
            );
            $this
                ->controlRedisClient
                ->del(
                    $channel
                );

            return;
        }

        if ($event === AbstractCall::CALL_SETUP) {
            $this->logger->info(
                "[SETEX] " . $channel . "\n" . json_encode($payload)
            );
            $this
                ->controlRedisClient
                ->setEx(
                    $channel,
                    self::REDIS_KEYS_TTL,
                    json_encode($payload)
                );

            return;
        }

        $dataStr = $this
            ->controlRedisClient
            ->get(
                $channel
            );

        $data = json_decode(
            $dataStr,
            true
        );

        if (!$data) {
            $this->logger->info(
                "No data found for call " . $channel
            );
            return;
        }

        if ($event === AbstractCall::UPDATE_CLID) {
            $data['Party'] = $payload['Party'];
            $logInfo = $event . ' => party ' . $data['Party'];
        } else {
            $data['Event'] = $event;
            $logInfo = $event;
        }

        $this->logger->info(
            "[SETEX] " . $channel . " " . $logInfo
        );
        $this
            ->controlRedisClient
            ->setEx(
                $channel,
                self::REDIS_KEYS_TTL,
                json_encode($data)
            );
    }

    ///////////////////////////////////////////
    /// Client
    ///////////////////////////////////////////
    private function sendCurrentStateAndUpdates(Server $server, $fd, string $mask)
    {
        $server->push(
            $fd,
            'Subscribing'
        );

        Coroutine::create(function () use ($server, $fd, $mask) {

            $redisClient = $this
                ->redisPool
                ->get();

            $this->sendCurrentState(
                $redisClient,
                $mask,
                $server,
                $fd
            );

            $subscriber = new Subscriber(
                $redisClient,
                $mask,
                $fd
            );

            $this->logger->debug(
                "Register subscriber #" . $fd
            );
            $this->subscribers[$fd] = $subscriber;

            $this->forwardStateUpdates(
                $subscriber,
                $server,
                $fd
            );
        });
    }

    private function sendCurrentState(
        Redis $redisClient,
        string $mask,
        Server $server,
        $fd
    ) {
        $keys = $redisClient->keys($mask);
        $this->logger->info(
            "Sending current state (". $mask .") to #" . $fd
        );

        $currentState = $redisClient->mGet($keys);
        if (false === $currentState) {
            $this->logger->info('No call info found on redis');
            return;
        }

        $sortByTimeCallable = function ($a, $b) {
            $a = json_decode($a, true);
            $b = json_decode($b, true);

            if ($a['Time'] === $b['Time']) {
                return 0;
            }

            return ($a['Time'] < $b['Time']) ? -1 : 1;
        };
        usort(
            $currentState,
            $sortByTimeCallable
        );

        foreach ($currentState as $payload) {
            $server->push(
                $fd,
                $payload
            );
        }
    }

    private function forwardStateUpdates(
        Subscriber $subscriber,
        Server $server,
        $fd
    ) {
        $redisClient = $subscriber->getRedisClient();

        while ($msg = $redisClient->recv()) {
            list(, , $command) = $msg;
            $argument = $msg[3] ?? null;

            $unsubscribe =
                $command == Subscriber::UNSUBSCRIBE_CHANNEL
                && $argument === (string) $fd;

            if ($unsubscribe) {
                $this->logger->debug(
                    'Unsubscribe on #' . $fd
                );
                break;
            }

            if (!$argument) {
                continue;
            }

            if (!isset($server->connections[$fd])) {
                $this->logger->info(
                    "Connection not found on #" . $fd
                );
                break;
            }

            $payload = json_decode($argument, true);

            $forward =
                $payload
                && in_array(
                    $payload['Event'] ?? null,
                    AbstractCall::SIGNIFICANT_CALL_EVENTS,
                    true
                );

            if (!$forward) {
                $this->logger->debug(
                    "Do not forward to #" . $fd . " message: " . $argument
                );
                continue;
            }

            $this->logger->debug(
                "Pushing to #" . $fd . " message: " . $argument
            );

            $server->push(
                $fd,
                $argument
            );
        }

        unset($this->subscribers[$fd]);

        $this->redisPool->push(
            $redisClient
        );
    }
}
