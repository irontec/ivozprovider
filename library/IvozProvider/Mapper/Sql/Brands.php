<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\Brands
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class Brands extends Raw\Brands
{

    protected function _save(\IvozProvider\Model\Raw\Brands $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        $this->_updateDomains($model);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Brand may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    protected function _updateDomains($model)
    {
        $pk = $model->getPrimaryKey();
        $domainMapper = new \IvozProvider\Mapper\Sql\Domains();
    
        $proxies = array('proxyusers', 'proxytrunks');
        foreach ($proxies as $proxy) {
            $domains = $domainMapper->fetchList("brandId=$pk AND PointsTo='$proxy'");
            if (empty($domains)) {
                $domain = new \IvozProvider\Model\Domains();
            } else {
                $domain = $domains[0];
            }
    
            $name = ($proxy == 'proxyusers') ? $model->getDomainUsers() : $model->getDomainTrunks();
            $name = trim($name);
            if (!$name) {
                $domain->delete();
                continue;
            }

            $domain->setDomain($name)
                   ->setScope('brand')
                   ->setPointsTo($proxy)
                   ->setBrandId($pk)
                   ->setDescription($model->getName() . " $proxy domain")
                   ->save();
        }
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Brand may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => array("lcr.reload", "domain.reload"),
                'proxyusers' => "domain.reload",
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }

    protected function _testLogs()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $logger = $bootstrap->getResource('log');

        $logger->log("EMERG", \Zend_Log::EMERG);
        $logger->log("ALERT", \Zend_Log::ALERT);
        $logger->log("CRIT", \Zend_Log::CRIT);
        $logger->log("ERR", \Zend_Log::ERR);
        $logger->log("WARN", \Zend_Log::WARN);
        $logger->log("NOTICE", \Zend_Log::NOTICE);
        $logger->log("INFO", \Zend_Log::INFO);
        $logger->log("DEBUG", \Zend_Log::DEBUG);
        $logger->log("[MAIL] Mensaje por e-mail", \Zend_Log::INFO);
        $logger->log("[Brands] Mensaje por e-mail", \Zend_Log::NOTICE);
    }

}
