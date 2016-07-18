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
 * Data Mapper implementation for IvozProvider\Model\RoutingPatternGroups
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class RoutingPatternGroups extends Raw\RoutingPatternGroups
{
    protected function _save(\IvozProvider\Model\Raw\RoutingPatternGroups $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNotNew = $model->getPrimaryKey();

        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);

        if ($isNotNew) {
            // If any LcrRule uses this PatternGroup, update accordingly
            $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();
            $outgoingRoutings = $outgoingRoutingMapper->findByField("routingPatternGroupId", $pk);

            if (!empty($outgoingRoutings)) {
                foreach ($outgoingRoutings as $outgoingRouting) {
                    $outgoingRoutingMapper->updateLCRPerOutgoingRouting($outgoingRouting);
                    // updateLCRPerOutgoingRouting calls lcr.reload
                }
            }
        }
        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        // If any LcrRule uses this PatternGroup, update accordingly
        $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();
        $outgoingRoutings = $outgoingRoutingMapper->findByField("routingPatternGroupId", $model->getPrimaryKey());

        $isUsed = 0;
        if (!empty($outgoingRoutings)) {
            $isUsed = 1;
        }

        $response = parent::delete($model);

        if ($isUsed) {
            try {
                $this->_sendXmlRcp();
            } catch (\Exception $e) {
                $message = $e->getMessage()."<p>Outgoing routing may have been deleted.</p>";
                throw new \Exception($message);
            }
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
