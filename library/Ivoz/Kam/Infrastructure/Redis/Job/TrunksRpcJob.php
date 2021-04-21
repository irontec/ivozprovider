<?php

namespace Ivoz\Kam\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Kam\Domain\Job\RpcJobInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Psr\Log\LoggerInterface;

class TrunksRpcJob implements RpcJobInterface
{
    protected $redisMasterFactory;
    protected $redisDb;
    protected $logger;

    protected $rpcEntity;
    protected $rpcPort;

    public function __construct(
        RedisMasterFactory $redisMasterFactory,
        int $redisDb,
        LoggerInterface $logger,
        string $rpcEntity = ProxyTrunk::class,
        int $rpcPort = 8001
    ) {
        $this->redisMasterFactory = $redisMasterFactory;
        $this->redisDb = $redisDb;
        $this->logger = $logger;

        $this->rpcEntity = $rpcEntity;
        $this->rpcPort = $rpcPort;
    }

    public function send(string $method, bool $retryOnError = false): void
    {
        try {
            if (!in_array($method, TrunksClientInterface::TRUNKS_ACTIONS, true)) {
                throw new \RuntimeException('Unexpected method ' . $method);
            }

            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $channel = $retryOnError
                ? self::CHANNEL_RETRY_ON_ERROR
                : self::CHANNEL;

            $data = [
                'rpcEntity' => $this->rpcEntity,
                'rpcPort' => $this->rpcPort,
                'rpcMethod' => $method,
            ];

            $redisClient->rPush(
                $channel,
                \json_encode($data)
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this
                ->logger
                ->error(
                    $e->getMessage()
                );

            throw $e;
        }
    }
}
