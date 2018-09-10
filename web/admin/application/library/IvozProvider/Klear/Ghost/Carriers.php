<?php

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
        $response = $this->fetchCallStats->getAsr(
            $carrierDto->getId()
        );

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
        $response = $this->fetchCallStats->getAcd(
            $carrierDto->getId()
        );

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

        return $this->fetchCarrierBalance->getBalance(
            $carrierDto->getBrandId(),
            $carrierDto->getId()
        );
    }
}
