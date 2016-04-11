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
 * Data Mapper implementation for Oasis\Model\PeerServers
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;

use Oasis\Gearmand\Jobs\Xmlrpc;
class PeerServers extends Raw\PeerServers
{

    protected function _save(\Oasis\Model\Raw\PeerServers $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNotNewAndPeeringContractHasChanged = $model->getId() != "" && $model->hasChange("peeringContractId");
        if ( $model->getBrandId() == "" || $isNotNewAndPeeringContractHasChanged) {

            $peerContract = $model->getPeeringContract();
            if (!$peerContract) {
                throw new \Exception("Unknown PeeringContract");
            }

            $brand = $peerContract->getBrand();
            if (!$brand) {
                throw new \Exception("Unknown Brand");
            }

            $model->setBrandId($brand->getId());
        }
        
        $flag = $model->getSendPAI() + ($model->getSendRPID()*2) + ($model->getUseAuthUserAsFromUser()*4);
        $model->setFlags($flag);

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        if ($pk) {
            // Replicar IP del PeerServer en kam_address.ip
            $kamAddressMapper = new \Oasis\Mapper\Sql\KamAddress();
            $kamAddress = $kamAddressMapper->findOneByField('peerServerId', $pk);
            if (is_null($kamAddress)) {
                $kamAddress = new \Oasis\Model\KamAddress();
                $kamAddress->setPeerServerId($pk);
            }

            $kamAddress->setIpAddr($model->getIp())->save();
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Peer srever may have been saved.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function delete(\Oasis\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>Peer srever may have been deleted.</p>";
            throw new \Exception($message);
        }
        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => array(
                        "permissions.addressReload",
                        "lcr.reload"
                        )
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
