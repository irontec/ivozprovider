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
 * Data Mapper implementation for Oasis\Model\PeeringContractsRelLcrRules
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;

use Oasis\Gearmand\Jobs\Xmlrpc;
class PeeringContractsRelLcrRules extends Raw\PeeringContractsRelLcrRules
{

    protected function _save(\Oasis\Model\Raw\PeeringContractsRelLcrRules $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {

        $existsAndHasChanged = (
                                $model->hasChange("lcrRuleId") ||
                                $model->hasChange("peeringContractId") ||
                                $model->hasChange("priority") ||
                                $model->hasChange("weight")
                               ) && $model->getPrimaryKey();

        if ($existsAndHasChanged) {
            $lcrRuleTargets = $model->getLcrRuleTarget();
            foreach ($lcrRuleTargets as $lcrRuleTarget) {
                $lcrRuleTarget->delete();
            }
        }

        if (!$model->getPrimaryKey() || $existsAndHasChanged) {
            $this->_addRuleTargetPerPeerServer($model);
        }

        $response = parent::_save($model, true, $useTransaction, $transactionTag, $forceInsert);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>PeeringContractsRelLcrRule may have been saved.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    public function delete(\Oasis\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>PeeringContractsRelLcrRule Rule may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _addRuleTargetPerPeerServer($model) {
        $peeringContract = $model->getPeeringContract();
        if (empty($peeringContract)) {
            throw new \Exception("Peering Contract not found");
        }

        $peerServers = $peeringContract->getPeerServers();

        if (empty($peerServers)) {
            throw new \Exception("Peer Servers not found");
        }

        foreach ($peerServers as $peerServer) {
            $lrcRuleTarget = new \Oasis\Model\LcrRuleTarget();
            $lrcRuleTarget->setBrandId($model->getBrandId())
                          ->setRuleId($model->getLcrRuleId())
                          ->setGwId($peerServer->getId())
                          ->setPriority($model->getPriority())
                          ->setWeight($model->getWeight());

            $model->addLcrRuleTarget($lrcRuleTarget);


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
}
