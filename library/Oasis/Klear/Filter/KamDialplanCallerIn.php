<?php

class Oasis_Klear_Filter_KamDialplanCallerIn implements KlearMatrix_Model_Interfaces_FilterList
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        //Get Action
        $currentAction = $routeDispatcher->getActionName();

        //Get Controller
        $currentController = $routeDispatcher->getControllerName();

        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        //NUESTRA CONDICIÓN CON CODIO WHERE MYSQL

        switch ($currentItemName) {
            case "transformationRulesetGroupsTrunksList_screen":
            case "kamTrunksDialplan_caller_inList_screen":
                $mapper = new \Oasis\Mapper\Sql\TransformationRulesetGroupsTrunks();
                break;
            case "transformationRulesetGroupsUsersList_screen":
            case "kamUsersDialplan_caller_inList_screen":
                $mapper = new \Oasis\Mapper\Sql\TransformationRulesetGroupsUsers();
                break;
            default:
                throw new Klear_Exception_Default("List screen not valid");
                break;
        }

        $transformationRulesetGroupModel = $mapper->find($routeDispatcher->getParam("pk"));
        $filterValue = $transformationRulesetGroupModel->getCallerIn();
        $condition = "dpid = ".$filterValue;
        if (is_null($filterValue)) {
            $condition = "dpid is null";
        }

        $this->_condition[] = $condition;

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return ;
    }

}
