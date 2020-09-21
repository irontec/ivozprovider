<?php

/**
 * Class IvozProvider_Klear_Filter_CompanyOrBrand
 *
 * Filter results for the current emulated company or brand
 *
 * @note multiple filters inherit from this one
 */
class IvozProvider_Klear_Filter_CompanyOrBrand implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("No company emulated");
        }

        $loggedUser = $auth->getIdentity();
        $currentCompanyId = $loggedUser->companyId;
        $currentBrandId = $loggedUser->brandId;

        $this->_condition[] = "self::company = '" . $currentCompanyId . "'";
        $this->_condition[] = "self::brand = '" . $currentBrandId . "'";

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" OR ", $this->_condition) . ')'];
        }
    }
}
