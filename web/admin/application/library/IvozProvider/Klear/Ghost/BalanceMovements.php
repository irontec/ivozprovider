<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Company\Company;

class IvozProvider_Klear_Ghost_BalanceMovements extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param BalanceMovementDto $balanceMovement
     * @return string amount with currency symbol
     */
    public function getAmount($balanceMovement)
    {
        if ($balanceMovement->getCompanyId()) {
            $currencySymbol = $this->getCompanyCurrencySymbol(
                $balanceMovement->getCompanyId()
            );
        } else {
            $currencySymbol = $this->getCarrierCurrencySymbol(
                $balanceMovement->getCarrierId()
            );
        }

        return sprintf(
            "%s %s",
            $balanceMovement->getAmount(),
            $currencySymbol
        );
    }

    /**
     * @param BalanceMovementDto $balanceMovement
     * @return string balance with currency symbol
     */
    public function getBalance($balanceMovement)
    {
        if ($balanceMovement->getCompanyId()) {
            $currencySymbol = $this->getCompanyCurrencySymbol(
                $balanceMovement->getCompanyId()
            );
        } else {
            $currencySymbol = $this->getCarrierCurrencySymbol(
                $balanceMovement->getCarrierId()
            );
        }

        return sprintf(
            "%s %s",
            $balanceMovement->getBalance(),
            $currencySymbol
        );
    }

    private function getCompanyCurrencySymbol($companyId)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            Company::class,
            $companyId,
            'getCurrencySymbol',
            []
        );
    }

    private function getCarrierCurrencySymbol($carrierId)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        return $dataGateway->remoteProcedureCall(
            Carrier::class,
            $carrierId,
            'getCurrencySymbol',
            []
        );
    }
}
