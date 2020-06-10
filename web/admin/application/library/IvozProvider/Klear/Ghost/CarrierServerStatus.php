<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;

class IvozProvider_Klear_Ghost_CarrierServerStatus extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * Get CarrierServer Status
     * @param CarrierServerDto $carrierServerDto
     * @return string HTML code to display carrier server status
     * @throws Zend_Exception
     */
    public function getCarrierServerStatusIcon($carrierServerDto)
    {
        if (!$carrierServerDto->getId()) {
            return '<span class="ui-silk inline ui-silk-error" title="No carrier server assigned"></span>';
        }

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var TrunksLcrGatewayDto $kamTrunksLcrGateway */
        $kamTrunksLcrGateway = $dataGateway->findOneBy(
            TrunksLcrGateway::class,
            [
                "TrunksLcrGateway.carrierServer = :carrierServerId",
                ["carrierServerId" => $carrierServerDto->getId()]
            ]
        );

        if (!$kamTrunksLcrGateway) {
            return '<span class="ui-silk inline ui-silk-error" title="No carrier server assigned"></span>';
        }

        /** @var TrunksClientInterface $trunksClient */
        $trunksClient = \Zend_Registry::get('container')->get(
            TrunksClientInterface::class
        );

        try {
            $dumpGw = $trunksClient->getLcrGatewayInfo(
                $kamTrunksLcrGateway->getId()
            );
        } catch (\Exception $e) {
            return '<span class="ui-silk inline ui-silk-error" title="Error retrieving status"></span>';
        }

        $status = $dumpGw['state'] ?? '';

        if ($status === 0) {
            $response = '<span class="ui-silk inline ui-silk-tick" title="Active"></span>';
        } else {
            $response = '<span class="ui-silk inline ui-silk-exclamation" title="Inactive""></span>';
        }

        return $response;
    }

    /**
     * Get Carrier Status
     * @param CarrierDto $carrierDto
     * @return string HTML code to display carrier status
     * @throws Zend_Exception
     */
    public function getCarrierStatusIcon($carrierDto)
    {
        if (!$carrierDto->getId()) {
            return '<span class="ui-silk inline ui-silk-error" title="No carrier assigned"></span>';
        }

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var CarrierServerDto $carrierServers */
        $carrierServers = $dataGateway->findBy(
            CarrierServer::class,
            [
                "CarrierServer.carrier = :carrierId",
                ["carrierId" => $carrierDto->getId()]

            ]
        );

        $status = 0;
        foreach ($carrierServers as $carrierServer) {
            /** @var TrunksLcrGatewayDto $kamTrunksLcrGateway */
            $kamTrunksLcrGateway = $dataGateway->findOneBy(
                TrunksLcrGateway::class,
                [
                    "TrunksLcrGateway.carrierServer = :carrierServerId",
                    ["carrierServerId" => $carrierServer->getId()]

                ]
            );

            if (!$kamTrunksLcrGateway) {
                return '<span class="ui-silk inline ui-silk-error" title="No carrier server assigned"></span>';
            }

            /** @var TrunksClientInterface $trunksClient */
            $trunksClient = \Zend_Registry::get('container')->get(
                TrunksClientInterface::class
            );

            try {
                $dumpGw = $trunksClient->getLcrGatewayInfo(
                    $kamTrunksLcrGateway->getId()
                );
            } catch (\Exception $e) {
                return '<span class="ui-silk inline ui-silk-error" title="Error retrieving status"></span>';
            }

            // 0: active - 2: inactive (defaults to inactive)
            $status += $dumpGw['state'] ?? 2;
        }


        if ($status === 0) {
            $response = '<span class="ui-silk inline ui-silk-tick" title="All servers active"></span>';
        } elseif ($status === 2*count($carrierServers)) {
            $response = '<span class="ui-silk inline ui-silk-exclamation" title="All server inactive"></span>';
        } else {
            $response = '<span class="ui-silk inline ui-silk-error" title="'. $status / 2 .' of ' .count($carrierServers). ' servers inactive"></span>';
        }

        return $response;
    }
}
