<?php

use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Service\Service;

/**
 * Class IvozProvider_Klear_Filter_CompanyServices
 *
 * Filter Service Listbox to avoid displaying Services not present in the Brand
 * Filter Service Listbox to avoid displaying Services already present in the Company
 */
class IvozProvider_Klear_Filter_CompanyServices implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No company emulated");
        }

        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
            "companyServicesList_screen",
            "companyServicesEdit_screen",
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }


        $loggedUser = $auth->getIdentity();
        $currentBrandyId = $loggedUser->brandId;
        $currentCompanyId = $loggedUser->companyId;

        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var BrandServiceDto[] $brandServices */
        $brandServices = $dataGateway->findBy(
            BrandService::class,
            ["BrandService.brand = " . $currentBrandyId]
        );

        $brandServicesIds = array();
        foreach ($brandServices as $brandService) {
            $serviceIden = $brandService->getService()->getIden();
            if (in_array($serviceIden, Service::VPBX_AVAILABLE_SERVICES, true)) {
                array_push($brandServicesIds, $brandService->getServiceId());
            }
        }

        if (count($brandServicesIds)) {
            $this->_condition[] = "self::id IN (" . implode(',', $brandServicesIds) . ")";
        } else {
            $this->_condition[] = "self::id IS NULL";  // Hackish
        }

        /** @var CompanyServiceDto[] $companyServices */
        $companyServices = $dataGateway->findBy(
            CompanyService::class,
            ["CompanyService.company = " . $currentCompanyId]
        );

        $companyServicesIds = array();
        foreach ($companyServices as $companyService) {
            array_push($companyServicesIds, $companyService->getServiceId());
        }

        if (count($companyServicesIds)) {
            $this->_condition[] = "self::id NOT IN (" . implode(',', $companyServicesIds) . ")";
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
    }
}
