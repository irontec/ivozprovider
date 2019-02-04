<?php

use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Cgr\Domain\Service\TpCdrStat\FetchCallStatsServiceInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface;

class IvozProvider_Klear_Ghost_Carriers extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @var FetchCallStatsServiceInterface
     */
    private $fetchCallStats;

    /**
     * @var CarrierBalanceServiceInterface
     */
    private $fetchCarrierBalance;

    public function __construct()
    {
        $serviceContainer = \Zend_Registry::get('container');
        $this->fetchCallStats = $serviceContainer->get(
            FetchCallStatsServiceInterface::class
        );
        $this->fetchCarrierBalance = $serviceContainer->get(
            CarrierBalanceServiceInterface::class
        );
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrierDto
     * @return string
     */
    public function getAsr($carrierDto)
    {
        try {
            $response = $this->fetchCallStats->getAsr(
                $carrierDto->getId()
            );
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("Unavailable")');
        }

        if (!$response || $response == -1) {
            return '';
        }

        return  round($response, 2) . '%';
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     * @return string
     */
    public function getAcd($carrierDto)
    {
        try {
            $response = $this->fetchCallStats->getAcd(
                $carrierDto->getId()
            );
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("Unavailable")');
        }

        if (!$response || $response == -1) {
            return '';
        }

        return round($response, 1) . ' s';
    }

    /**
     * @param CarrierDto $carrierDto
     * @return string
     */
    public function getBalance(CarrierDto $carrierDto)
    {
        if (!$carrierDto->getCalculateCost()) {
            return Klear_Model_Gettext::gettextCheck('_("Disabled")');
        }

        try {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $balance =  $this->fetchCarrierBalance->getBalance(
                $carrierDto->getBrandId(),
                $carrierDto->getId()
            );

            $currencySymbol = $dataGateway->remoteProcedureCall(
                Carrier::class,
                $carrierDto->getId(),
                'getCurrencySymbol',
                []
            );

            return sprintf(
                "%s %s",
                $balance,
                $currencySymbol
            );
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("Unavailable")');
        }
    }
}
