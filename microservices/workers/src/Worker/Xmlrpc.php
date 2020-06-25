<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use GearmanJob;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Infrastructure\Kamailio\RpcClient;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserRepository;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Monolog\Logger;
use PhpXmlRpc\Client;
use PhpXmlRpc\Request;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

/**
 * @Gearman\Work(
 *     name = "Xmlrpc",
 *     description = "Handle XMLRPC requests related async tasks",
 *     service = "Worker\Xmlrpc",
 *     iterations = 1
 * )
 */
class Xmlrpc
{
    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $em;
    private $logger;
    private $retryInterval = 180;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        EntityManagerInterface $em,
        Logger $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Send Inmmediate XMLRPC request to Kamailio Proxies
     *
     *
     * @Gearman\Job(
     *     name = "immediate",
     *     description = "Send XMLRPC request immediatly"
     * )
     *
     * @param GearmanJob $serializedJob Object with job parameters
     * @return boolean
     */
    public function immediate(GearmanJob $serializedJob)
    {
        try {
            // Thanks Gearmand, you've done your job
            $serializedJob->sendComplete("DONE");
            $this->registerCommand('Worker', 'xmlrpc');

            /** @var \Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc $job */
            $job = igbinary_unserialize($serializedJob->workload());

            return $this->sendRpcRequest(
                $job->getRpcEntity(),
                $job->getRpcPort(),
                $job->getRpcMethod()
            );
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }
    }

    /**
     * Send delayed XMLRPC request to Kamailio Proxies
     *
     * @param GearmanJob $serializedJob Object with job parameters
     *
     * @return boolean
     *
     * @Gearman\Job(
     *     name = "delayed",
     *     description = "Send XMLRPC request delayed"
     * )
     */
    public function delayed(GearmanJob $serializedJob)
    {
        try {

            /** @var \Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc $job */
            $job = igbinary_unserialize($serializedJob->workload());

            $success = $this->sendRpcRequest(
                $job->getRpcEntity(),
                $job->getRpcPort(),
                $job->getRpcMethod()
            );

            if (!$success) {
                $this->logger->info(sprintf(
                    "[KAM-RPC] Delayed %s job request failed: Retrying in %d seconds.",
                    $job->getRpcMethod(),
                    $this->retryInterval
                ));
                sleep($this->retryInterval);
                exit(GEARMAN_WORK_ERROR);
            }

            // Thanks Gearmand, you've done your job
            $serializedJob->sendComplete("DONE");
            return $success;
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            exit(1);
        }
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
}
