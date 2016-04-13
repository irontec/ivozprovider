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
        //NUESTRA CONDICIÓN CON CODIO WHERE MYSQL
        $pk = $routeDispatcher->getParam("pk", false);
        //Screen de la que partimos
        $parentId = $routeDispatcher->getParam("parentId", false);
        $parentScreen = $routeDispatcher->getParam("parentScreen", false);

        $isUserListScreen = ($currentScreen == "usersList_screen");
        if ($isUserListScreen) {
            return true;
        }

        $isUserEditScreen = ($currentScreen == "usersEdit_screen");
        $isUserNewScreen = ($currentScreen == "usersNew_screen");

        if ($isUserEditScreen || $isUserNewScreen) {
            //Filter extensions in use
            $subquery = "SELECT `extensionId` FROM `Users` WHERE extensionId IS NOT NULL";
            if ($isUserEditScreen) {
                $userExtensionId = $this->_getUserExtensionId($pk);
    	        $subquery .= " AND `extensionId` != '" . $userExtensionId. "'";
            }
            $this->_condition[] = "`id` NOT IN (".$subquery.")";
           $this->_condition[] = " `routeType` = 'user'";
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
