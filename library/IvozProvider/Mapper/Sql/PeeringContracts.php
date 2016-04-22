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
 * Data Mapper implementation for IvozProvider\Model\PeeringContracts
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class PeeringContracts extends Raw\PeeringContracts
{
    protected function _save(\IvozProvider\Model\Raw\PeeringContracts $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        //$peerServerMapper = new PeerServers;
        if ( $model->hasChange("brandId")) {

            $peerServers = $model->getPeerServers();
            foreach ($peerServers as $peerServer) {

                $brand = $model->getBrand();
                $peerServer->setBrandId($brand->getId());
                $recursive = true;
                //$peerServerMapper->saveRecursive($peerServer, $useTransaction, $transactionTag, $forceInsert);
            }
        }

        return parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        // If any OutgoingRouting uses this PeeringContract, lcr.reload
        $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();
        $outgoingRoutings = $outgoingRoutingMapper->findByField("peeringContractId", $model->getPrimaryKey());

        $response = parent::delete($model);

        if (!empty($outgoingRoutings)) {
            try {
                $this->_sendXmlRcp();
            } catch (\Exception $e) {
                $message = $e->getMessage()."<p>PeeringContract may have been deleted.</p>";
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
