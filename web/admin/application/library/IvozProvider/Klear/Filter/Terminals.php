<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
 * Class IvozProvider_Klear_Filter_Terminals
 *
 * Filter Terminals Listbox to only display not assigned Terminals or Terminals already assigned to the User
 */
class IvozProvider_Klear_Filter_Terminals extends IvozProvider_Klear_Filter_Company
{
    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Do not apply filtering in list view
        if ($routeDispatcher->getControllerName() == "list") {
            return;
        }

        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        // Get current company
        $auth = Zend_Auth::getInstance();
        $loggedUser = $auth->getIdentity();
        $currentCompanyId = $loggedUser->companyId;

        // Get used terminals from company users
        /** @var UserDto[] $companyUsers */
        $companyUsers = $dataGateway->findBy(
            User::class,
            [
                "User.company = " . $currentCompanyId
            ]
        );

        // Get current edited user (if any)
        $pk = $routeDispatcher->getParam("pk", false);

        // Remove from the list all used terminals and the currently assigned to the user
        $terminalIds = [];
        foreach ($companyUsers as $companyUser) {
            if ($companyUser->getId() != $pk && $companyUser->getTerminalId()) {
                $terminalIds[] = $companyUser->getTerminalId();
            }
        }

        if (!empty($terminalIds)) {
            $this->_condition[] = 'self::id NOT IN ('. implode(',', $terminalIds) .')';
        }

        return true;
    }
}
