<?php

/**
 * Class IvozProvider_Klear_Filter_Extensions
 *
 * Filter Extension Listbox to only display not assigned Extensions or Extensions already assigned to the User
 */
class IvozProvider_Klear_Filter_Extensions extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        $controller = $routeDispatcher->getControllerName();
        if (!in_array($controller, ['edit', 'new'], true)) {
            return true;
        }

        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);

        //Get ModelName and your Controller
        $currentScreen = $routeDispatcher->getCurrentItemName();
        $pk = $routeDispatcher->getParam("pk", false);

        $isUserEditScreen = ($currentScreen == "usersEdit_screen");
        $isUserNewScreen = ($currentScreen == "usersNew_screen");

        if ($isUserNewScreen) {
            $this->_condition[] = " self::routeType IS NULL";
        }

        if ($isUserEditScreen) {
            $this->_condition[] = " (IDENTITY(self::user) = $pk OR self::routeType IS NULL) ";
        }
        return true;
    }
}
