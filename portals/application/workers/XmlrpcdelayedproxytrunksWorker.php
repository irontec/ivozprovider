<?php


use IvozProvider\Mapper\Sql\MusicOnHold;
class XmlrpcdelayedproxytrunksWorker extends Iron_Gearman_Worker
{
    protected $_waitTime = 155;  // seconds
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_mapper;
    protected $_frontend;
    protected $_xmlRpcServers;
    protected $_logger;
    protected $_bootstrap;

    protected function initRegisterFunctions()
    {

        $this->_registerFunction = array(
                'sendXMLRPCDelayedProxyTrunks' => 'send'
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
                if (!$this->_canBeSent($serverName, $jobObject)) {
                    return;
                }
                if (!is_array($methods)) {
                    $methods = array($methods);
                }
                foreach ($methods as $method) {
                    $date = new Zend_Date();
                    $now = $date->toString("YYYY/MM/dd - HH:MM:ss");
                    $lastSentFile = "/var/log/gearmand/xmlrpcdelayed.".$serverName.".last";
                    try {
                        $client->call($method);
                        $message = "[OK] Module ".$method." of ".$serverName." reloaded successfully.";
                        $xmlrpcLogsMapper = new \IvozProvider\Mapper\Sql\XMLRPCLogs();
                        $jobLog = $xmlrpcLogsMapper->find($jobObject->getId());
                        $jobLog->setFinishDate(new \Zend_Date())->save();
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

    protected function _canBeSent($proxyServer, $job)
    {
        $xmlrpcLogsMapper = new \IvozProvider\Mapper\Sql\XMLRPCLogs();

        $jobLog = $xmlrpcLogsMapper->find($job->getId());
        $jobLog->setExecDate(new \Zend_Date())->save();

        $jobStartDate = new \Zend_Date($jobLog->getStartDate());
        $jobStart = intval($jobStartDate->getTimestamp());

        $jobExecDate = new \Zend_Date($jobLog->getExecDate());
        $jobExec = intval($jobExecDate->getTimestamp());

        $wheres = array(
                "proxy = 'trunks'",
                "module = 'uac'",
                "method = 'reg_reload'",
                "finishDate is not null",
                "id != '".$job->getId()."'"
        );

        $lastLog = $xmlrpcLogsMapper->fetchOne(implode(" AND ", $wheres), "finishDate desc");

        if (empty($lastLog)) {
            return true;
        }

        $lastDate = new \Zend_Date($lastLog->getFinishDate());
        $lastSent = intval($lastDate->getTimestamp());


        if ($jobStart <= $lastSent) {
            $infoMessage = "\n[INFO] Allready reloaded.";
            $jobLog->setFinishDate($lastDate)->save();
            $this->_logger->log($infoMessage, Zend_Log::INFO);
            return false;
        }

        $elapsedSeconds = $jobExec - $lastSent;

        if ($elapsedSeconds >= $_waitTime) {
            return true;
        }

        $diference = $_waitTime - $elapsedSeconds;
        $infoMessage = "[INFO] Waitting ".$diference." seconds to send.";
        $this->_logger->log($infoMessage, Zend_Log::INFO);
        sleep($diference);
        return true;
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
