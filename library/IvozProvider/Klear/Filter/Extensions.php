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
            $this->_condition[] = " routeType IS NULL";
        }

        if ($isUserEditScreen) {
            $this->_condition[] = " (userId = $pk OR routeType IS NULL) ";
        }
        return true;
    }

    protected function _getUserExtensionId($pk)
    {
        $user = $this->_getUserByPk($pk);
        return $user->getExtensionId();
    }

    protected function _getUserByPk($pk)
    {
        $userMapper = new IvozProvider\Mapper\Sql\Users;
        $user = $userMapper->find($pk);

        if (!$user) {
            throw new \Exception("userId '{$pk}' not found");
        }

        return $user;
    }
}
