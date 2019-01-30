<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface;

class IvozProvider_Klear_Ghost_Companies extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @var CompanyBalanceServiceInterface
     */
    private $fetchCompanyBalance;

    public function __construct()
    {
        $serviceContainer = \Zend_Registry::get('container');
        $this->fetchCompanyBalance = $serviceContainer->get(
            CompanyBalanceServiceInterface::class
        );
    }

    /**
     * @param CompanyDto $model
     * @return string
     */
    public function getTypeIcon($model)
    {
        switch ($model->getType()) {
            case Company::VPBX:
                return '<span class="ui-silk inline ui-silk-building" title="Company"></span>';
            case Company::RETAIL:
                return '<span class="ui-silk inline ui-silk-basket" title="Retail"></span>';
            case Company::WHOLESALE:
                return '<span class="ui-silk inline ui-silk-cart" title="Wholesale"></span>';
            case Company::RESIDENTIAL:
                return '<span class="ui-silk inline ui-silk-house" title="Residential"></span>';
            default:
                return $model->getType();
        }
    }

    /**
     * @param CompanyDto $companyDto
     * @return string
     */
    public function getBalance(CompanyDto $companyDto)
    {
        try {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $amount = $this->fetchCompanyBalance->getBalance(
                $companyDto->getBrandId(),
                $companyDto->getId()
            );

            $currencySymbol = $dataGateway->remoteProcedureCall(
                Company::class,
                $companyDto->getId(),
                'getCurrencySymbol',
                []
            );

            return sprintf("%s %s", $amount, $currencySymbol);
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("Unavailable")');
        }
    }
}
