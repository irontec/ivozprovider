<?php
namespace Oasis\Gearmand\Jobs;

class Xmlrpcdelayedproxyusers extends AbstractJob {

    protected $_proxyServers;

    protected $_mainVariables = array(
            '_proxyServers'
    );


    protected $_method = "sendXMLRPCDelayedProxyUsers";

    public function setProxyServers($proxyServers) {
        $this->_proxyServers = $proxyServers;
    }

    public function getProxyServers()
    {
        return $this->_proxyServers;
    }

}