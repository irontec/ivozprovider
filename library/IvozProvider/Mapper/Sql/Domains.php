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
 * Data Mapper implementation for IvozProvider\Model\Domains
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class Domains extends Raw\Domains
{
    protected function _save(\IvozProvider\Model\Raw\Domains $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Domain may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Domain may have been saved.</p>";
            throw new \Exception($message);
        }

        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxyusers' => "domain.reload"
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
