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
 * Data Mapper implementation for IvozProvider\Model\PeerServers
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;

use IvozProvider\Gearmand\Jobs\Xmlrpc;
class PeerServers extends Raw\PeerServers
{

    protected function _save(\IvozProvider\Model\Raw\PeerServers $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $isNew = !$model->getPrimaryKey();

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

        if ($model->auth_needed == 'no') {
            $model->setAuthUser(null);
            $model->setAuthPassword(null);
        }

        # --- SIP Proxy and Outbound Proxy logic

        $sip_proxy = explode(':', $model->getSipProxy());
        $hostname = array_shift($sip_proxy);
        $port = array_shift($sip_proxy);

        if ($model->getOutboundProxy()) {
            $outbound_proxy = explode(':', $model->getOutboundProxy());
            $ip = array_shift($outbound_proxy);
            $ob_port = array_shift($outbound_proxy);
            if (!is_null($port)) {
                throw new \Exception("When Outbound Proxy is used, SIP Proxy must not include a port.", 70003);
            } else {
                $port = $ob_port;
            }
        } else {
            $ip = null;
            $model->setOutboundProxy(null);
        }

        if (!is_numeric($port) or !$port) {
            $port = 5060;
        }

        // Validate IP
        if (!is_null($ip) && !filter_var($ip, FILTER_VALIDATE_IP, array(FILTER_FLAG_IPV4))) {
            throw new \Exception("Outbound Proxy IP value is not valid.", 70004);
        }

        // Save validated values
        $model->setHostname($hostname);
        $model->setIp($ip);
        $model->setPort($port);

        # --- SIP Proxy and Outbound Proxy logic - End

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        // Update LCR tables
        $lcrGateway = $model->getLcrGateway();
        if (is_null($lcrGateway)) {
            $lcrGateway = new \IvozProvider\Model\LcrGateways();
        }

        // Update/Create LcrGateway for this PeerServer
        $lcrGateway->setGwName($model->getName())
                   ->setIp($model->getIp())
                   ->setHostname($model->getHostname())
                   ->setPort($model->getPort())
                   ->setParams($model->getParams())
                   ->setUriScheme($model->getUriScheme())
                   ->setTransport($model->getTransport())
                   ->setStrip($model->getStrip())
                   ->setPrefix($model->getPrefix())
                   ->setTag($model->getId())
                   ->setFlags($model->getFlags())
                   ->setPeerServerId($model->getId())
                   ->save();

        if ($isNew) {
            $outgoingRoutings = $model->getPeeringContract()->getOutgoingRouting();
            $outgoingRoutingMapper = new \IvozProvider\Mapper\Sql\OutgoingRouting();

            foreach ($outgoingRoutings as $outgoingRouting) {
                $outgoingRoutingMapper->updateLCRPerOutgoingRouting($outgoingRouting);
            }
        }

        try {
            $this->_sendXmlRcp();
        } catch (\Exception $e) {
            $message = $e->getMessage()."<p>LCR Gateways may have been reloaded.</p>";
            throw new \Exception($message);
        }

        return $pk;
    }

    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        // If any Outgoing Routing used this PeerServer, reload lcr module
        $outgoingRoutings = $model->getPeeringContract()->getOutgoingRouting();

        $response = parent::delete($model);

        if (!empty($outgoingRoutings)) {
            try {
                $this->_sendXmlRcp();
            } catch (\Exception $e) {
                $message = $e->getMessage()."<p>LCR Gateways may have been reloaded.</p>";
                throw new \Exception($message);
            }
        }

        return $response;
    }

    protected function _sendXmlRcp()
    {
        $proxyServers = array(
                'proxytrunks' => array(
                        "lcr.reload",
                        )
        );
        $xmlrpcJob = new Xmlrpc();
        $xmlrpcJob->setProxyServers($proxyServers);
        $xmlrpcJob->send();
    }
}
