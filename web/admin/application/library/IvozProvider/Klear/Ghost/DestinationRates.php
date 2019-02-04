<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup;

class IvozProvider_Klear_Ghost_DestinationRates extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param DestinationRateDto $destinationRate
     * @return string ConnectionFee with currency symbol
     */
    public function getConnectFee($destinationRate)
    {
        $currencySymbol = $this->getDestinationRateGroupCurrencySymbol(
            $destinationRate->getDestinationRateGroupId()
        );

        return sprintf(
            "%s %s",
            $destinationRate->getConnectFee(),
            $currencySymbol
        );
    }

    /**
     * @param DestinationRateDto $destinationRate
     * @return string Cost with currency symbol
     */
    public function getCost($destinationRate)
    {
        $currencySymbol = $this->getDestinationRateGroupCurrencySymbol(
            $destinationRate->getDestinationRateGroupId()
        );

        return sprintf(
            "%s %s",
            $destinationRate->getCost(),
            $currencySymbol
        );
    }

    private function getDestinationRateGroupCurrencySymbol($destinationRateGroupId)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            DestinationRateGroup::class,
            $destinationRateGroupId,
            'getCurrencySymbol',
            []
        );
    }
}
