<?php
class IvozProvider_Klear_Filter_BrandServices implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Get Action
        $currentAction = $routeDispatcher->getActionName();

        // Get Controller
        $currentController = $routeDispatcher->getControllerName();

        // Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
                "brandServicesList_screen",
                "brandServicesEdit_screen",
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        // Get Current Emulated brand
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
            $this->_condition[] = "`id` NOT IN (" . implode(',', $servicesIds) . ")";
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
