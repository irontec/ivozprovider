<?php

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * Class IvozProvider_Klear_Filter_FriendInterCompany
 */
class IvozProvider_Klear_Filter_FriendInterCompany extends IvozProvider_Klear_Filter_Brand
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        $auth = \Zend_Auth::getInstance();

        /** @var \IvozProvider\Klear\Auth\User $loggedUser */
        $loggedUser = $auth->getIdentity();

        // Remove current emulated company from the list
        $this->_condition[] = "self::id != " . $loggedUser->companyId;
        $this->_condition[] = "self::type = '" . CompanyInterface::TYPE_VPBX . "'";

        return true;
    }
}
