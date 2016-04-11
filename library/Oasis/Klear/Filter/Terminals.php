<?php

class Oasis_Klear_Filter_Terminals extends Oasis_Klear_Filter_Company
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
            "usersList_screen"
        );

        if (in_array($currentItemName, $unfilteredScreens)) {
            return true;
        }

        $pk = $routeDispatcher->getParam("pk", false);
        
        if ($pk) {
            $this->_condition[] = "`id` NOT IN (SELECT `terminalId` FROM `Users` WHERE terminalId IS NOT NULL AND `id` != '".$pk."')";
        } else {
            $this->_condition[] = "`id` NOT IN (SELECT `terminalId` FROM `Users` WHERE terminalId IS NOT NULL)";
        }

        return true;
    }

}
