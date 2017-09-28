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

        $brandServiceMapper = new \IvozProvider\Mapper\Sql\BrandServices();
        $brandServices = $brandServiceMapper->fetchList("`brandId` = " . $currentBrandyId);

        $servicesIds = array();
        foreach ($brandServices as $brandService) {
            array_push($servicesIds, $brandService->getServiceId());
        }
        if (count($servicesIds)) {
            $this->_condition[] = "`id` IN (" . implode(',', $servicesIds) . ")";
        } else {
            $this->_condition[] = "`id` IS NULL";  // Hackish
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
