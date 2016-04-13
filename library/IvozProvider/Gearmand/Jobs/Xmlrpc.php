<?php
namespace IvozProvider\Gearmand\Jobs;

class Xmlrpc extends AbstractJob {

    protected $_proxyServers;

    protected $_mainVariables = array(
            '_proxyServers'
    );


    protected $_method = "sendXMLRPC";

    public function setProxyServers($proxyServers) {
        $this->_proxyServers = $proxyServers;
    }

    public function getProxyServers()
    {
        return $this->_proxyServers;
    }

}