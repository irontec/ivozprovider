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

//         $this->_testLogs();


        $isNewBrand = is_null($model->getPrimaryKey());
        $domainHasChanged = $model->hasChange("domain");

        $response =  parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($isNewBrand || $domainHasChanged) {
            try {
                $this->_sendXmlRcp();
            } catch (\Exception $e) {
                $message = $e->getMessage()."<p>Brand may have been saved.</p>";
                throw new \Exception($message);
            }
        }
        return $response;
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
                'proxytrunks' => "domain.reload",
                'proxyusers' => "domain.reload"
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
