<?php
class IvozProvider_Klear_Filter_Users extends IvozProvider_Klear_Filter_Company
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

        return true;
    }
}
