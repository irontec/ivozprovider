<?php

class IvozProvider_Klear_Filter_Terminals extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();
        $unfilteredScreens = ['usersList_screen'];

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        $pk = $routeDispatcher->getParam("pk", false);
        if ($pk && !is_array($pk)) {

            $dataGateway = \Zend_Registry::get('data_gateway');

            $ids = $dataGateway->runNamedQuery(
                \Ivoz\Provider\Domain\Model\User\User::class,
                'getAssignedTerminalIds',
                [[$pk]]
            );

            if (!empty($ids)) {
                $this->_condition = ['self::id NOT IN ('. implode(',', $ids) .')'];
            }
        }

        return true;
    }

}
