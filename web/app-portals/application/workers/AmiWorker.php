<?php


use Oasis\Mapper\Sql\MusicOnHold;
class AmiWorker extends Iron_Gearman_Worker
{
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_mapper;
    protected $_amiUserName;
    protected $_amiPassword;
    protected $_amiPort;

    protected function initRegisterFunctions()
    {

        $this->_registerFunction = array(
                'reloadDialplan' => 'reloadDialplan',
                'sendFax' => 'sendFax'
        );
    }

    protected function init()
    {
        $this->_mapper = new MusicOnHold();

        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        if (is_null($bootstrap)) {
            $conf = new \Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
            $config = (Object) $conf->toArray();
        } else {
            $config = (Object) $bootstrap->getOptions();
        }

        $this->_amiUserName = $config->ami["userName"];
        $this->_amiPassword = $config->ami["password"];
        $this->_amiPort = $config->ami["port"];

    }

    protected function timeout()
    {
        $this->_mapper->getDbTable()->getAdapter()->closeConnection();
    }

    public function reloadDialplan(\GearmanJob $serializedJob)
    {
        $this->_logger->log("[GEARMAND][DIALPLAN] Reloading dialplan...", \Zend_Log::INFO);
        $job = igbinary_unserialize($serializedJob->workload());

        $applicationServer = $job->getApplicationServer();
        if (is_null($applicationServer)) {
            $message = "[GEARMAND][DIALPLAN] Can't reload Dialplan. No application server setted for this company.";
            $this->_logger->log($message, \Zend_Log::ERR);
            return;
        }
        $ip = $applicationServer->getIp();
        $headers = array(
            "Action" => "Command",
            "Command" => "Dialplan Reload"
        );
        $ami = new \Ami_Connector($ip, $this->_amiPort, $this->_amiUserName, $this->_amiPassword);
        $ami->setLogger($this->_logger)
            ->setHeaders($headers);
        $response = $ami->send();
        if ($response === false) {
            $this->_logger->log("[GEARMAND][DIALPLAN] Error reloading dialplan.", \Zend_Log::ERR);
        } else {
            $message = "[GEARMAND][DIALPLAN] Dialplan reload response was '".$response["rawResponse"]."'";
            $this->_logger->log($message, \Zend_Log::INFO);
        }

    }

    public function sendFax(\GearmanJob $serializedJob)
    {
        $this->_logger->log("[GEARMAND][FAX] Sending fax...", \Zend_Log::INFO);
        $job = igbinary_unserialize($serializedJob->workload());
        $fax = $job->getFaxInOut();
        $dest = $fax->getDst();
        $id = $fax->getPrimaryKey();
        $file = $fax->fetchFile()->getFilePath();

        $fileTIF = $file.".tif";
        // Set destination file an fax options
        shell_exec("/usr/bin/gs -r400x400 -g3456x4676 -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=a4 -sOutputFile=$fileTIF $file 2>&1 >/dev/null");

        $headers = array(
                "Action" => "Originate",
                "Channel" => "Local/".$dest."@shared-faxout-dial",
                "Context" => "shared-faxout",
                "Exten" => $dest,
                "Priority" => 1,
                "Variable" => "FAX_ID=".$id.",FAXFILE=".$fileTIF
        );

        $applicationSerersMapper = new \Oasis\Mapper\Sql\ApplicationServers();
        $applicationServer = $applicationSerersMapper->findOneByField("name", "asfax");
        $ip = $applicationServer->getIp();

        $ami = new \Ami_Connector($ip, $this->_amiPort, $this->_amiUserName, $this->_amiPassword);
        $ami->setLogger($this->_logger)
        ->setHeaders($headers);
        $response = $ami->send();
        if ($response === false) {
            $this->_logger->log("[GEARMAND][FAX] Error sending fax.", \Zend_Log::ERR);
        } else {
            $message = "[GEARMAND][FAX] Fax sending message was: '".$response["rawResponse"]."'";
            $this->_logger->log($message, \Zend_Log::INFO);
        }
    }

}
