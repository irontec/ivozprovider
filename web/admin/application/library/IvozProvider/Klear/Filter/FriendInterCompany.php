<?php

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;

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

        // Edit screen does not require filtering, this field is read-only
        $currentScreen = $routeDispatcher->getCurrentItemName();
        $isFriendEditScreen = ($currentScreen == "friendsEdit_screen");
        if ($isFriendEditScreen) {
            return true;
        }

        // Remove current emulated company from the list
        $this->_condition[] = "self::id != " . $loggedUser->companyId;
        $this->_condition[] = "self::type = '" . CompanyInterface::TYPE_VPBX . "'";

        // Filter companies of the same corporationId
        $coporationIdSubQuery = sprintf(
            'SELECT IDENTITY(Companies.corporation) FROM %s AS Companies WHERE Companies.id = %d',
            Company::class,
            $loggedUser->companyId
        );
        $this->_condition[] = "self::corporation = (" . $coporationIdSubQuery . ")";

        // Filter out companies that already have an intervpbx Friend with current company
        $unusedFriendsSubQuery = sprintf(
            'SELECT IDENTITY(Friends.interCompany) FROM %s AS Friends WHERE Friends.company = %d',
            Friend::class,
            $loggedUser->companyId
        );
        $this->_condition[] = "self::id NOT IN (" . $unusedFriendsSubQuery . ")";
        return true;
    }
}
