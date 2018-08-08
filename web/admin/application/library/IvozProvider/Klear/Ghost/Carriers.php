<?php

use Ivoz\Cgr\Infrastructure\Domain\Service\Cgrates\FetchCallStatsService;

class IvozProvider_Klear_Ghost_Carriers extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @var FetchCallStatsService
     */
    private $fetchCallStats;

    public function __construct()
    {
        $serviceContainer = \Zend_Registry::get('container');
        $this->fetchCallStats = $serviceContainer->get(
            FetchCallStatsService::class
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
}
