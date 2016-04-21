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
 * Data Mapper implementation for IvozProvider\Model\TargetPatterns
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class TargetPatterns extends Raw\TargetPatterns
{
    protected function _save(\IvozProvider\Model\Raw\TargetPatterns $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);

        
        $lcrRulesMapper = new \IvozProvider\Mapper\Sql\LcrRules();
        $lcrRule = $lcrRulesMapper->findOneByField("targetPatternId", $pk);

        if (is_null($lcrRule)) {
            $lcrRule = new \IvozProvider\Model\LcrRules();
        }
        $lcrRule->setBrandId($model->getBrandId())
              ->setTag($model->getName())
              ->setDescription($model->getDescription())
              ->setTargetPatternId($pk)
              ->setCondition($model->getRegExp())
              ->save();

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Target pattern may have been saved.</p>";
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
            $message = $e->getMessage()."<p>Target pattern may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => "lcr.reload",
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }

}
