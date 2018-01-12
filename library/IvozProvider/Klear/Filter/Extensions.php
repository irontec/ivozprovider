<?php
class IvozProvider_Klear_Filter_Extensions extends IvozProvider_Klear_Filter_Company
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        // Add parent filters
        parent::setRouteDispatcher($routeDispatcher);
        //Get ModelName and your Controller
        $currentScreen = $routeDispatcher->getCurrentItemName();
        $pk = $routeDispatcher->getParam("pk", false);

        //Screen de la que partimos
        $isUserListScreen = ($currentScreen == "usersList_screen");
        if ($isUserListScreen) {
            return true;
        }

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
