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
 * Data Mapper implementation for IvozProvider\Model\TargetGroups
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class TargetGroups extends Raw\TargetGroups
{
    protected function _save(\IvozProvider\Model\Raw\TargetGroups $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);

        $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();
        $outgoingRoutings = $model->getOutgoingRouting();
        foreach ($outgoingRoutings as $outgoingRouting) {
            $outgoingRoutingMapper->updateLCRPerOutgoingRouting($outgoingRouting);
        }
        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        // If any OutgoingRouting uses this PatternGroup, lcr.reload
        $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();
        $outgoingRoutings = $outgoingRoutingMapper->findByField("targetGroupId", $model->getPrimaryKey());

        $response = parent::delete($model);

        if (!empty($outgoingRoutings)) {
            try {
                $this->_sendXmlRcp();
            } catch (\Exception $e) {
                $message = $e->getMessage()."<p>Destiny group may have been deleted.</p>";
                throw new \Exception($message);
            }
        }

        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => array(
                        "lcr.reload"
                        )
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
