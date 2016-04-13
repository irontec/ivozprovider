<?php

class IvozProvider_Klear_Filter_ExternalCallFiltersMultiselect implements KlearMatrix_Model_Field_Select_Filter_Interface
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

        $pk = $routeDispatcher->getParam("pk", false);
        $parentId = $routeDispatcher->getParam("parentId", false);
        $parentScreen = $routeDispatcher->getParam("parentScreen", false);
        switch ($currentItemName) {
            case "calendarsNew_screen":
                if ($parentId) {
                    $this->_condition[] = "`companyId` = '".$parentId."'";
                }
                break;
            case "calendarsEdit_screen":
                if ($pk) {
                    $calendarsMapper = new \IvozProvider\Mapper\Sql\Calendars();
                    $calendarModel = $calendarsMapper->find($pk);
                    $companyId = $calendarModel->getCompanyId();
                    $this->_condition[] = "`companyId` = '".$companyId."'";
                }
                break;
            case "schedulesEdit_screen":
                if ($pk && $parentScreen) {
                    $schedulesMapper = new \IvozProvider\Mapper\Sql\Schedules();
                    $scheduleModel = $schedulesMapper->find($pk);
                    $companyId = $scheduleModel->getCompanyId();
                    $this->_condition[] = "`companyId` = '".$companyId."'";
                }
                break;
            case "schedulesNew_screen":
                if ($parentId) {
                    $this->_condition[] = "`companyId` = '".$parentId."'";
                }
                break;
        }

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
