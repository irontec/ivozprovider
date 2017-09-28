<?php
class IvozProvider_Klear_Filter_Company implements KlearMatrix_Model_Field_Select_Filter_Interface
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

        $this->_condition = ["self::company = '" . $currentCompanyId . "'"];

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
