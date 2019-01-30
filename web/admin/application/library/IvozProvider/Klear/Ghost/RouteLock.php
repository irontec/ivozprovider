<?php

use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;

class IvozProvider_Klear_Ghost_RouteLock extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     * Draw icon based on lock status
     *
     * @param RouteLockDto $routeLockDto
     * @return string
     */
    public function getLockStatusIcon($routeLockDto)
    {
        if ($routeLockDto->getOpen() == '1') {
            return '<span class="ui-silk inline ui-silk-tick" title="Opened"/>';
        } else {
            return '<span class="ui-silk inline ui-silk-stop" title="Closed"/>';
        }
    }

    /**
     * Get Service Extension for opening a given route lock
     *
     * @param RouteLockDto $routeLockDto
     * @return string
     *
     * @throws Zend_Exception
     */
    public function getOpenExtension($routeLockDto)
    {
        return $this->getServiceExtension($routeLockDto, "OpenLock");
    }

    /**
     * Get Service Extension for closing a given route lock
     *
     * @param RouteLockDto $routeLockDto
     * @return string
     *
     * @throws Zend_Exception
     */
    public function getCloseExtension($routeLockDto)
    {
        return $this->getServiceExtension($routeLockDto, "CloseLock");
    }

    /**
     * Get Service Extension for toggling a given route lock
     *
     * @param RouteLockDto $routeLockDto
     * @return string
     *
     * @throws Zend_Exception
     */
    public function getToggleExtension($routeLockDto)
    {
        return $this->getServiceExtension($routeLockDto, "ToggleLock");
    }

    /**
     * Get Service Extension for managing route locks
     *
     *
     * @param RouteLockDto $routeLockDto
     * @param string $iden
     * @return string
     *
     * @throws Zend_Exception
     */
    public function getServiceExtension($routeLockDto, $iden)
    {
        // Get Locution Service code
        $companyId = $routeLockDto->getCompanyId();
        $dataGateway = \Zend_Registry::get('data_gateway');

        /**
         * @var CompanyServiceDto[] $companyServices
         */
        $companyServices = $dataGateway->findBy(
            CompanyService::class,
            [
                'CompanyService.company = :companyId',
                ['companyId' => $companyId]
            ]
        );

        // Get Recording number for this locution
        foreach ($companyServices as $companyServiceDto) {

            /**
             * @var ServiceDto $service
             */
            $service = $dataGateway->find(
                Service::class,
                $companyServiceDto->getServiceId()
            );

            if ($service->getIden() === $iden) {
                return '*' . $companyServiceDto->getCode() . $routeLockDto->getId();
            }
        }

        return "";
    }
}
