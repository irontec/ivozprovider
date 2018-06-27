<?php


use IvozProvider\Mapper\Sql\MusicOnHold;
class XmlrpcWorker extends Iron_Gearman_Worker
{
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_mapper;
    protected $_frontend;
    protected $_xmlRpcServers;
    protected $_bootstrap;

    protected function initRegisterFunctions()
    {

        $this->_registerFunction = array(
                'sendXMLRPC' => 'send',
        );
    }

    protected function init()
    {
        $this->_mapper = new MusicOnHold();

        $this->_bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        if (is_null($this->_bootstrap)) {
            $conf = new \Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
            $config = (Object) $conf->toArray();
        } else {
            $config = (Object) $this->_bootstrap->getOptions();
        }

        $this->_xmlRpcServers = $config->xmlrpc;

    }

    protected function timeout()
    {
        $this->_mapper->getDbTable()->getAdapter()->closeConnection();
    }

    public function send(\GearmanJob $job)
    {
        // Thanks Gearmand, you've done your job
        $job->sendComplete("DONE");

        $jobObject = igbinary_unserialize($job->workload());

        $proxyServers = $jobObject->getProxyServers();
        $errorMessages = array();
        $n = 1;
        foreach ($proxyServers as $serverName => $methods) {

            if ($serverName == 'proxyusers') {
                $proxyMapper = new \IvozProvider\Mapper\Sql\ProxyUsers();
                $port = 8000;
            } else { // proxytrunks
                $proxyMapper = new \IvozProvider\Mapper\Sql\ProxyTrunks();
                $port = 8001;
            }

            $proxies = $proxyMapper->fetchList();
            foreach ($proxies as $proxy) {
                $client = new \Zend_XmlRpc_Client( 'http://' . $proxy->getIp() . ":$port/RPC2" );

                if (!is_array($methods)) {
                    $methods = array($methods);
                }

                foreach ($methods as $method) {
                    $date = new Zend_Date();
                    $now = $date->toString("YYYY/MM/dd - HH:MM:ss");
                    try {
                        $client->call($method);
                        $message = "[OK] Module ".$method." of ".$serverName." reloaded successfully.";
                        $this->_logger->log($message, Zend_Log::INFO);
                    } catch (\Exception $e) {
                        $message = "[ERROR] Error executing ".$method." in ".$serverName.". ".
                            "Error was:\n\t".$e->getMessage();
                        $errorMessages[] = $message;
                        $this->_logger->log($message, Zend_Log::ERR);
                    }
                }
            }
        }

        if (!empty($errorMessages)) {
            $errorMessage = "\n".implode("\n", $errorMessages);
            $this->_sendMail($errorMessage);
        }
    }

    protected function _sendMail($message)
    {
        $options = $this->_bootstrap->getOption('gearmand');
        $mailOptions = $options["mail"];

        $mail = new \Zend_Mail('UTF-8');
        $mail
        ->setBodyText($message)
        ->setSubject($mailOptions["subject"])
        ->setFrom($mailOptions["from"])
        ->addTo($mailOptions["to"])
        ->send();
    }
}
