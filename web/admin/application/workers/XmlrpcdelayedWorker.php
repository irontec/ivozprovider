<?php

class XmlrpcDelayedWorker extends Iron_Gearman_Worker
{
    /** @var  \Ivoz\Core\Application\Service\DataGateway */
    protected $dataGateway;

    protected $retryInterval = 180;

    protected function initRegisterFunctions()
    {
        $this->_registerFunction = array(
            'sendXMLRPCDelayed' => 'sendXMLRPCDelayed',
        );
    }

    protected function init()
    {
        if (\Zend_Registry::isRegistered("data_gateway")) {
            $this->dataGateway = \Zend_Registry::get("data_gateway");
        }
    }

    public function sendXMLRPCDelayed(\GearmanJob $serializedJob)
    {
        /** @var \IvozProvider\Gearmand\Jobs\Xmlrpc $job */
        $job = igbinary_unserialize($serializedJob->workload());
        $rpcEntity = $job->getRpcEntity();
        $rpcPort = $job->getRpcPort();
        $rpcMethod = $job->getRpcMethod();

        // Get servers to send the XmlRpcRequest
        $servers = $this->dataGateway->findAll($rpcEntity);

        foreach ($servers as $server) {
            try {
                // Create a new XmlRpc client for each server
                $client = new \Zend_XmlRpc_Client('http://' . $server->getIp() . ":$rpcPort/RPC2");
                $client->call($rpcMethod);

                $this->_logger->log(
                    sprintf("[XMLRPCDelayed] Request %s sent to %s [%s:%d]",
                        $rpcMethod,
                        $server->getName(),
                        $server->getIp(),
                        $rpcPort
                    ),
                    Zend_Log::INFO
                );

            } catch (\Exception $e) {
                $this->_logger->log(
                    sprintf("[XMLRPCDelayed] Unable to send request %s to server %s [%s:%d]: Retrying in %d seconds.",
                        $rpcMethod,
                        $server->getName(),
                        $server->getIp(),
                        $rpcPort,
                        $this->retryInterval
                    ),
                    Zend_Log::ERR
                );

                // Wait before processing the task again
                sleep($this->retryInterval);
                exit(1);
            }
        }

        // Job's done
        $serializedJob->sendComplete("DONE");

        // Job's done!
        exit(0);
    }
}
