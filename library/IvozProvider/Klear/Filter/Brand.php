<?php
class IvozProvider_Klear_Filter_Brand implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            //TODO Exceptionante
            throw new Klear_Exception_Default("No brand emulated");
        }
        $loggedUser = $auth->getIdentity();
        $currentBrandyId = $loggedUser->brandId;

        $this->_condition[] = "`brandId` = '".$currentBrandyId."'";

        if ($routeDispatcher->getParam('file') == 'PricingPlansList') {
            $this->_filterAutocompletePrincingPlans($routeDispatcher->getParam('term'));
        }

        return true;
    }

    protected function _filterAutocompletePrincingPlans($term) {
        if (is_numeric($term)) {
            $this->_condition[] = "`regExp` like '%".$term."%'";
        } elseif (substr($term, 0, 1) == '(') {
            $term = str_replace("(","",$term);
            $this->_condition[] = "`regExp` like '".$term."%'";
        } else {
            $this->_condition[] = "(`name_en` LIKE '%".str_replace(' ','%',$term)."%' OR `name_es` LIKE '%".str_replace(' ','%',$term)."%')";
        }
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }
}
