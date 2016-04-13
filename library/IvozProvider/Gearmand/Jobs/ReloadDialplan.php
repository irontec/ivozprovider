<?php
namespace IvozProvider\Gearmand\Jobs;

class ReloadDialplan extends AbstractJob {

    protected $_applicationServer;

    protected $_mainVariables = array(
            '_applicationServer'
    );


    protected $_method = "reloadDialplan";


    public function setApplicationServer($applicationServer)
    {
        $this->_applicationServer = $applicationServer;
        return $this;
    }

    public function getApplicationServer()
    {
        return $this->_applicationServer;
    }

}