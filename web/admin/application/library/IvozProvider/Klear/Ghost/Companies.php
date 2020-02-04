<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
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

    /**
     * @param CompanyDto $companyDto
     * @return string
     */
    public function getCurrentDayUsage(CompanyDto $companyDto)
    {
        try {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $amount = $this->fetchCompanyBalance->getCurrentDayUsage(
                $companyDto->getBrandId(),
                $companyDto->getId()
            );

            // If numeric amount, round to 2 decimals value
            if (is_numeric($amount)) {
                $amount = sprintf("%0.2f", floatval($amount));
            }

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

    /**
     * @param CompanyDto $companyDto
     * @return string
     */
    public function getCurrentDayMaxUsage(CompanyDto $companyDto)
    {
        try {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $amount = $this->fetchCompanyBalance->getCurrentDayMaxUsage(
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

    /**
     * @param CompanyDto $companyDto
     * @return string
     */
    public function getAccountStatus(CompanyDto $companyDto)
    {
        try {
            $disabled = $this->fetchCompanyBalance->getAccountStatus(
                $companyDto->getBrandId(),
                $companyDto->getId()
            );

            if (!$disabled) {
                return '<span class="ui-silk inline ui-silk-accept" title="Active"></span>';
            }

            return '<span class="ui-silk inline ui-silk-delete" title="Inactive"></span>';
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("Unavailable")');
        }
    }

    /**
     * @param CompanyDto $companyDto
     * @return string
     */
    public function getDdiE164(CompanyDto $companyDto)
    {
        try {
            if (!$companyDto->getOutgoingDdiId()) {
                return Klear_Model_Gettext::gettextCheck('_("Unassigned")');
            }

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var DdiDto $ddi */
            $ddi = $dataGateway->find(
                Ddi::class,
                $companyDto->getOutgoingDdiId()
            );

            return $ddi->getDdie164();
        } catch (Exception $exception) {
            return Klear_Model_Gettext::gettextCheck('_("error")');
        }
    }
}
