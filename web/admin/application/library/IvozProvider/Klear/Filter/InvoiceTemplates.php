<?php

/**
 * Class IvozProvider_Klear_Filter_InvoiceTemplates
 *
 * Filter InvoiceTemplate Listbox to only display current Brand's Invoice Templates and Global Templates
 */
class IvozProvider_Klear_Filter_InvoiceTemplates extends IvozProvider_Klear_Filter_Brand
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
