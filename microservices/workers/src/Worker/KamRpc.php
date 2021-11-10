<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\RegisterCommandTrait;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Kam\Domain\Job\RpcJobInterface;
use Ivoz\Kam\Infrastructure\Kamailio\RpcClient;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserRepository;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class KamRpc
{
    use RegisterCommandTrait;

    /** @todo retryInterval should be a constant */
    private $retryInterval = 180;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private EntityManagerInterface $em,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private Logger $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
    }

    public function send(): Response
    {
        try {
            $this->registerCommand('Worker', 'rpc::immediate');

            $job = $this->getJobPayload(
                RpcJobInterface::CHANNEL
            );

            $this->sendRpcRequest(
                $job['rpcEntity'],
                $job['rpcPort'],
                $job['rpcMethod']
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }

        return new Response('');
    }

    public function delayed(): Response
    {
        try {
            $this->registerCommand('Worker', 'rpc::delayed');

            $job = $this->getJobPayload(
                RpcJobInterface::CHANNEL_RETRY_ON_ERROR
            );

            $success = $this->sendRpcRequest(
                $job['rpcEntity'],
                $job['rpcPort'],
                $job['rpcMethod']
            );

            if (!$success) {
                $this->logger->info(sprintf(
                    "[KAM-RPC] Delayed %s job request failed: Retrying in %d seconds.",
                    $job['rpcMethod'],
                    $this->retryInterval
                ));

                sleep($this->retryInterval);

                $this->reEnqueueJob(
                    RpcJobInterface::CHANNEL_RETRY_ON_ERROR,
                    $job
                );

                exit(1);
            }
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }

        return new Response('');
    }

    /**
     * Send XML request to all servers of the given type
     *
     * @param string $entity Name of the servers
     * @param int $port RPC Port
     * @param string$method RPC Method
     *
     * @return bool
     */
    private function sendRpcRequest($entity, $port, $method)
    {
        try {

            /** @var ProxyTrunkRepository|ProxyUserRepository $repository */
            $repository = $this->em->getRepository($entity);
        } catch (\Exception $e) {
            $this->logger->error(
                sprintf("Unable to find repository for %s", $entity)
            );
            return false;
        }

        /** @var ProxyTrunk|ProxyUser $server */
        $server = $repository->getProxyMainAddress();

        try {
            $uri = sprintf(
                "http://%s:%d/%s",
                $server->getIp(),
                $port,
                $method
            );

            $this->logger->info(sprintf(
                "[KAM-RPC] About send a request to %s",
                $uri
            ));

            $client = RpcClient::factory($uri);

            $requestId = 1;
            $request = $client
                ->request(
                    $requestId,
                    $method,
                    []
                );

            /** @var \Graze\GuzzleHttp\JsonRpc\Message\Response $response */
            $response = $client->send($request);

            if ($response->getRpcErrorCode()) {
                throw new \Exception($response->getRpcErrorMessage());
            }
        } catch (\Exception $e) {
            $this->logger->error(sprintf(
                "[KAM-RPC] Unable to send request %s to server %s [%s:%d]: %s",
                $method,
                $server->getName(),
                $server->getIp(),
                $port,
                $e->getMessage()
            ));
            return false;
        }
        return true;
    }


    private function getJobPayload(string $channel): array
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            $timeoutSeconds = 60 * 60;
            $response = $redisMaster->blPop(
                [$channel],
                $timeoutSeconds
            );

            $data = end($response);
            return \json_decode($data, true);
        } catch (\RedisException $e) {
            $this->logger->error('KamRpc timeout: ' . $e->getMessage());
            exit(1);
        }
    }

    private function reEnqueueJob(string $channel, array $data): bool
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            $redisMaster->lPush(
                $channel,
                \json_encode($data)
            );

            $redisMaster->close();
        } catch (\RedisException $e) {
            $this->logger->error('KamRpc timeout: ' . $e->getMessage());

            return false;
        }

        return true;
    }
}
