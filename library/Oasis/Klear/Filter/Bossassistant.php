<?php

class Oasis_Klear_Filter_Bossassistant extends Oasis_Klear_Filter_Company
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

        //NUESTRA CONDICIÓN CON CODIO WHERE MYSQL
        $pk = $routeDispatcher->getParam("pk", false);

        $this->_condition[] = "`isBoss` = 0";
        $this->_condition[] = "`id` != '".$pk."'";
        //En este ejemplo decimos que solo muestre los valores cuyo campo Active = 1
        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }

}
