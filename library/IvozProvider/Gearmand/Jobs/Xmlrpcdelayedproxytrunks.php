<?php
namespace IvozProvider\Gearmand\Jobs;

class Xmlrpcdelayedproxytrunks extends AbstractJob {

    protected $_proxyServers;
    protected $_date;
    protected $_id;
    protected $_maperName;

    protected $_mainVariables = array(
            '_proxyServers', '_date', '_id', '_mapperName'
    );

    protected $_method = "sendXMLRPCDelayedProxyTrunks";

    public function setProxyServers($proxyServers) {
        $this->_proxyServers = $proxyServers;
        return $this;
    }

    public function getProxyServers()
    {
        return $this->_proxyServers;
    }

    public function setDate($date)
    {
        $this->_date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setMapperName($mapperName)
    {
        $this->_mapperName = $mapperName;
        return $this;
    }

    public function getMapperName()
    {
        return $this->_mapperName;
    }

    public function send()
    {

        $xmlrpcModel = new \IvozProvider\Model\XMLRPCLogs();
        $pk = $xmlrpcModel
            ->setMapperName($this->_mapperName)
            ->setProxy("trunks")
            ->setModule("uac")
            ->setMethod("reg_reload")
            ->save();

        $this->_id = $pk;
        parent::send();
    }
}