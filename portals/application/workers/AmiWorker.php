<?php


use IvozProvider\Mapper\Sql\MusicOnHold;
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

    public function sendFax(\GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        $this->_logger->log("[GEARMAND][FAX] Sending fax...", \Zend_Log::INFO);
        $job = igbinary_unserialize($serializedJob->workload());
        $fax = $job->getFaxInOut();
        $dest = $fax->getDst();
        $id = $fax->getPrimaryKey();
        $file = $fax->fetchFile()->getFilePath();

        $this->_logger->log("[GEARMAND][FAX] Converting PDF to TIFF...", \Zend_Log::INFO);
        $fileTIF = $file . ".tif";

        // Set destination file an fax options
        shell_exec("/usr/bin/gs -g1728x1145 -r209x98 -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=a4 -sOutputFile=$fileTIF $file 2>&1 >/dev/null");

        $headers = array(
                "Action" => "Originate",
                "Channel" => "Local/$dest@fax-out-leg0",
                "Context" => "fax-out-leg1",
                "Exten" => $dest,
                "Priority" => 1,
                "Variable" => "__FAXOUT_ID=".$id.",__FAXFILE=".$fileTIF
        );

        $applicationSerersMapper = new \IvozProvider\Mapper\Sql\ApplicationServers();
        $applicationServer = $applicationSerersMapper->fetchOne();
        //shuffle($applicationServers);
        $ip = $applicationServer->getIp();
        $this->_logger->log("[GEARMAND] Sending AMI Request to $ip...", \Zend_Log::INFO);

        $ami = new \Ami_Connector($ip, $this->_amiPort, $this->_amiUserName, $this->_amiPassword);
        $ami->setLogger($this->_logger)->setHeaders($headers);
        $response = $ami->send();
        if ($response === false) {
            $this->_logger->log("[GEARMAND][FAX] Error sending fax.", \Zend_Log::ERR);
        } else {
            $message = "[GEARMAND][FAX] Fax sending message was: '".$response["rawResponse"]."'";
            $this->_logger->log($message, \Zend_Log::INFO);
        }
    }

}
