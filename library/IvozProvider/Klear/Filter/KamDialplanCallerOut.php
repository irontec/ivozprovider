<?php

class IvozProvider_Klear_Filter_KamDialplanCallerOut implements KlearMatrix_Model_Interfaces_FilterList
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


        switch ($currentItemName) {
            case "transformationRulesetGroupsTrunksList_screen":
            case "kamTrunksDialplan_caller_outList_screen":
                $mapper = new \IvozProvider\Mapper\Sql\TransformationRulesetGroupsTrunks();
                break;
            case "transformationRulesetGroupsUsersList_screen":
            case "kamUsersDialplan_caller_outList_screen":
                $mapper = new \IvozProvider\Mapper\Sql\TransformationRulesetGroupsUsers();
                break;
            default:
                throw new Klear_Exception_Default("List screen not valid - KamDialanCallerOut -");
                break;
        }

        $transformationRulesetGroupModel = $mapper->find($routeDispatcher->getParam("pk"));
        $filterValue = $transformationRulesetGroupModel->getCallerOut();
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
