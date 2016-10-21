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
        if ($model->getType() == 'group') {
            $model->setRoutingPatternId(null);
        } elseif ($model->getType() == 'pattern') {
            $model->setRoutingPatternGroupId(null);
        } elseif ($model->getType() == 'fax') {
            $model->setRoutingPatternId(null);
            $model->setRoutingPatternGroupId(null);
        } else {
            throw new \Exception("Incorrect Outgoing Routing Type");
        }

        $pk = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);
        $this->updateLCRPerOutgoingRouting($model);

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>LCR module may have been reloaded.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function updateLCRPerOutgoingRouting($outgoingRouting)
    {
        // If edit, delete everything and fresh-start (claramente mejorable)
        $lcrRuleTargets = $outgoingRouting->getLcrRuleTargets("outgoingRoutingId=".$outgoingRouting->getPrimaryKey());
        foreach ($lcrRuleTargets as $lcrRuleTarget) {
            $lcrRuleTarget->delete();
        }

        $peeringContract = $outgoingRouting->getPeeringContract();
        if (empty($peeringContract)) {
            throw new \Exception("Peering Contract not found");
        }

        $peerServers = $peeringContract->getPeerServers();
        if (empty($peerServers)) {
            throw new \Exception("Peer Servers not found");
        }

        $lcrGateways = array();
        foreach ($peerServers as $peerServer) {
            $lcrGateways = array_merge($lcrGateways, $peerServer->getLcrGateways("peerServerId=".$peerServer->getId()));
        }

        $lcrRules = array();
        // Create LcrRule for each RoutingPattern
        if ($outgoingRouting->getType() == 'group') {
            foreach ($outgoingRouting->getRoutingPatternGroup()->getRoutingPatternGroupsRelPatterns() as $relPattern) {
                $lcrRule = $this->_getLcrRulePerPattern($outgoingRouting, $relPattern->getRoutingPattern());
                array_push($lcrRules, $lcrRule);
            }
        } elseif ($outgoingRouting->getType() == 'pattern') {
                $lcrRule = $this->_getLcrRulePerPattern($outgoingRouting, $outgoingRouting->getRoutingPattern());
                array_push($lcrRules, $lcrRule);
        } elseif ($outgoingRouting->getType() == 'fax') {
                $lcrRule = $this->_addLcrRuleForFax($outgoingRouting);
                array_push($lcrRules, $lcrRule);
        } else {
            throw new \Exception("Incorrect Outgoing Routing Type");
        }

        // Create n x m LcrRuleTargets (n LcrRules; m LcrGateways)
        foreach ($lcrRules as $lcrRule) {
            foreach ($lcrGateways as $lcrGateway) {
                $lcrRuleTarget = new \IvozProvider\Model\LcrRuleTargets();

                $lcrRuleTarget->setRuleId($lcrRule->getId())
                              ->setGwId($lcrGateway->getId())
                              ->setPriority($outgoingRouting->getPriority())
                              ->setWeight($outgoingRouting->getWeight())
                              ->setOutgoingRoutingId($outgoingRouting->getPrimaryKey())
                              ->save();
            }
        }
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>LCR module may have been reloaded.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _deleteRelated($mapper, $pk)
    {
        foreach ($mapper->findByField("outgoingRoutingId", $pk) as $item) {
            $item->delete();
        }
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


    protected function _getLcrRulePerPattern($model, $pattern)
    {
        if (!is_null($model->getCompany())) {
            $lcrRule = $pattern->getCompanyLcrRulePerPattern($model->getCompany());
        } else {
            $lcrRule = $pattern->getGenericLcrRulePerPattern();
        }

        if (is_null($lcrRule)) {
            $lcrRule = new \IvozProvider\Model\LcrRules();
        }

        if (!is_null($model->getCompany())) {
            $from_uri = '^' . $model->getCompany()->getDomain() . '$';
            $lcrRule->setFromUri($from_uri);
        }

        $lcrRule->setTag($pattern->getName())
                ->setDescription($pattern->getDescription())
                ->setRoutingPatternId($pattern->getId())
                ->setCondition($pattern->getRegExp())
                ->save();

        return $lcrRule;
    }

    protected function _addLcrRuleForFax($model)
    {
        $lcrRule = new \IvozProvider\Model\LcrRules();
        $lcrRule->setTag("fax")
                ->setDescription("Special route for fax")
                ->setCondition("fax")
                ->save();

        return $lcrRule;
    }
}
