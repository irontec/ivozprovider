<?php

class IvozProvider_Klear_Filter_Terminals extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        //Get Action
        $currentAction = $routeDispatcher->getActionName();

        //Get Controller
        $currentController = $routeDispatcher->getControllerName();

        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $unfilteredScreens = array(
            \Ivoz\Provider\Domain\Model\User\User::class,
            []
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        $pk = $routeDispatcher->getParam("pk", false);
        if (!is_array($pk)) {

            $dataGateway = \Zend_Registry::get('data_gateway');

            /** @var \Ivoz\Provider\Domain\Model\User\UserDTO $user */
            $user = $dataGateway->find(
                \Ivoz\Provider\Domain\Model\User\User::class,
                $pk
            );

            $ids = $dataGateway->runNamedQuery(
                \Ivoz\Provider\Domain\Model\User\User::class,
                'getAssignedTerminalIds',
                []
            );

            // Do not remove current user terminal
            if ($user->getTerminalId()) {
                $ids = array_diff($ids, array($user->getTerminalId()));
            }

            if (!empty($ids)) {
                $this->_condition[] = 'self::id NOT IN ('. implode(',', $ids) .')';
            }
        }

        return true;
    }

}
