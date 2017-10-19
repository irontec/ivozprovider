<?php
class IvozProvider_Klear_Filter_CompanyServices implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No brand emulated");
        }

        $loggedUser = $auth->getIdentity();
        $currentBrandyId = $loggedUser->brandId;

        $dataGateway = \Zend_Registry::get('data_gateway');
        /**
         * @var \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[] $brandServices
         */
        $brandServices = $dataGateway->findBy(
            'Ivoz\Provider\Domain\Model\BrandService\BrandService',
            ["BrandService.brand = " . $currentBrandyId]
        );

        $servicesIds = array();
        foreach ($brandServices as $brandService) {
            array_push($servicesIds, $brandService->getServiceId());
        }

        if (count($servicesIds)) {
            $this->_condition[] = "self::id IN (" . implode(',', $servicesIds) . ")";
        } else {
            $this->_condition[] = "self::id IS NULL";  // Hackish
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return;
    }
}
