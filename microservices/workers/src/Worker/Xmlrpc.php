<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use GearmanJob;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Monolog\Logger;
use PhpXmlRpc\Client;
use PhpXmlRpc\Request;

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
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Retry interval for delayed jobs
     *
     * @var int
     */
    protected $retryInterval = 180;

    /**
     * Xmlrpc constructor.
     *
     * @param EntityManagerInterface $em
     * @param Logger $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        Logger $logger
    ) {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Send Inmmediate XMLRPC request to Kamailio Proxies
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
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        /** @var \Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc $job */
        $job = igbinary_unserialize($serializedJob->workload());

        return $this->sendXmlRpcRequest(
            $job->getRpcEntity(),
            $job->getRpcPort(),
            $job->getRpcMethod()
        );
    }

    /**
     * Send delayed XMLRPC request to Kamailio Proxies
     *
     * @param GearmanJob $job Object with job parameters
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
        /** @var \Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Xmlrpc $job */
        $job = igbinary_unserialize($serializedJob->workload());

        $success = $this->sendXmlRpcRequest(
            $job->getRpcEntity(),
            $job->getRpcPort(),
            $job->getRpcMethod()
        );

        if (!$success) {
            $this->logger->info(sprintf("[XMLRPC] Delayed %s job request failed: Retrying in %d seconds.",
               $job->getRpcMethod(), $this->retryInterval)
            );
            sleep($this->retryInterval);
            exit(GEARMAN_WORK_ERROR);
        }

        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");
        return $success;
    }


    /**
     * Send XML request to all servers of the given type
     *
     * @param $entity Entity Name of the servers
     * @param $port RPC Port
     * @param $method RPC Method
     *
     * @return bool
     */
    private function sendXmlRpcRequest($entity, $port, $method)
    {
        // Get servers to send the XmlRpcRequest
        $repository = $this->em->getRepository($entity);
        if (!$repository) {
            $this->logger->error(sprintf("Unable to find repository for %s", $entity));
            return false;
        }

        /** @var ProxyTrunk[]|ProxyUser[] $servers */
        $servers = $repository->findAll();

        foreach ($servers as $server) {
            try {
                // Create a new XmlRpc client for each server
                $client = new Client(sprintf("http://%s:%d/RPC2",  $server->getIp(), $port));
                $client->setUserAgent("xmlrpclib");
                $response = $client->send(new Request($method));

                if ($response->errno) {
                    throw new \Exception($response->errstr);
                }

                $this->logger->info(sprintf("[XMLRPC] Request %s sent to %s [%s:%d]",
                    $method, $server->getName(), $server->getIp(), $port
                ));

            } catch (\Exception $e) {
                $this->logger->error(sprintf("[XMLRPC] Unable to send request %s to server %s [%s:%d]",
                    $method, $server->getName(), $server->getIp(), $port
                ));
                return false;
            }
        }
        return true;
    }

}
