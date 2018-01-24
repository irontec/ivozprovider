<?php

/**
 * Class IvozProvider_Klear_Filter_MatchList
 *
 * Filter MatchList Listbox to display both Brand's and Company's match lists
 */
class IvozProvider_Klear_Filter_MatchList implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new \Exception("No company emulated");
        }
        $loggedUser = $auth->getIdentity();
        $currentCompanyId = $loggedUser->companyId;
        $currentBrandId = $loggedUser->brandId;

        $this->_condition = [
            "self::company = '" . $currentCompanyId . "'" .
            " OR " .
            "self::brand = '" . $currentBrandId . "'"
        ];

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return null;
    }
}
