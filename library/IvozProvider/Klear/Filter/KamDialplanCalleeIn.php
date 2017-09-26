<?php

use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunk;

class IvozProvider_Klear_Filter_KamDialplanCalleeIn implements KlearMatrix_Model_Interfaces_FilterList
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
            case "kamTrunksDialplan_callee_inList_screen":

                $entity = TransformationRulesetGroupsTrunk::class;
                break;
//            case "transformationRulesetGroupsUsersList_screen":
//            case "kamUsersDialplan_callee_inList_screen":
//                $mapper = new \IvozProvider\Mapper\Sql\TransformationRulesetGroupsUsers();
//                break;
            default:
                throw new Klear_Exception_Default("List screen not valid");
                break;
        }

        $pk = $routeDispatcher->getParam("pk");
        $dataGateway = \Zend_Registry::get('data_gateway');
        $transformationRulesetGroupModel = $dataGateway->find(
            $entity,
            $pk
        );

        $filterValue = $transformationRulesetGroupModel->getCalleeIn();
        $condition = "self::dpid = " . $filterValue;
        if (is_null($filterValue)) {
            $condition = "self::dpid is null";
        }

        $this->_condition[] = $condition;

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return ;
    }

}
