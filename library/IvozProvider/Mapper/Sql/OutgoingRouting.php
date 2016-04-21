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
 * Data Mapper implementation for IvozProvider\Model\OutgoingRouting
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
use IvozProvider\Gearmand\Jobs\Xmlrpc;

class OutgoingRouting extends Raw\OutgoingRouting
{

    protected function _save(\IvozProvider\Model\Raw\OutgoingRouting $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);

        
        $lcrRuleTargetMapper = new \IvozProvider\Mapper\Sql\LcrRuleTarget();
        $lcrRuleTargets = $lcrRuleTargetMapper->findByField("outgoingRoutingId", $pk);

        foreach ($lcrRuleTargets as $lcrRuleTarget) {
            $lcrRuleTarget->delete();
        }

        $peeringContract = $model->getPeeringContract();
        if (empty($peeringContract)) {
            throw new \Exception("Peering Contract not found");
        }

        $peerServers = $peeringContract->getPeerServers();

        if (empty($peerServers)) {
            throw new \Exception("Peer Servers not found");
        }

        $LcrRules = array();

        foreach ($peerServers as $peerServer) {
            if ($model->getType() == 'group') {
                $relPatterns = $model->getTargetGroup()->getTargetGroupsRelPatterns();
                foreach ($relPatterns as $relPattern) {
                    $LcrRules = array_merge($LcrRules, $relPattern->getTargetPattern()->getLcrRules());
                }
            } elseif ($model->getType() == 'pattern') {
                $LcrRules = array_merge($LcrRules, $model->getTargetPattern()->getLcrRules());
            } else {
                throw new \Exception("Incorrect outgoing routing Type");
            }

            foreach ($LcrRules as $LcrRule) {
                $lrcRuleTarget = new \IvozProvider\Model\LcrRuleTarget();
                $lrcRuleTarget->setBrandId($model->getBrandId())
                              ->setCompanyId($model->getCompanyId())
                              ->setRuleId($LcrRule->getId())
                              ->setGwId($peerServer->getId())
                              ->setPriority($model->getPriority())
                              ->setWeight($model->getWeight())
                              ->setOutgoingRoutingId($model->getPrimaryKey())
                              ->save();
            }
        }

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
            $message = $e->getMessage()."<p>Outgoing routing may have been deleted.</p>";
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
