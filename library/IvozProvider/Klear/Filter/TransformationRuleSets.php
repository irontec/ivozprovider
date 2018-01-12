<?php
class IvozProvider_Klear_Filter_TransformationRuleSets extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default('No brand emulated');
        }

        $loggedUser = $auth->getIdentity();
        $currentBrandyId = $loggedUser->brandId;

        $this->_condition[] = "self::brand IS NULL";
        $this->_condition[] = "self::brand = '" . $currentBrandyId . "'";

        if ($routeDispatcher->getParam('file') == 'PricingPlansList') {
            $this->_filterAutocompletePrincingPlans($routeDispatcher->getParam('term'));
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" OR ", $this->_condition) . ')'];
        }
        return null;
    }
}
