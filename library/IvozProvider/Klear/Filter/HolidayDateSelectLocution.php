<?php

class IvozProvider_Klear_Filter_HolidayDateSelectLocution implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        throw new \Exception('Not implemented yet');
        //Get Action
        $currentAction = $routeDispatcher->getActionName();

        //Get Controller
        $currentController = $routeDispatcher->getControllerName();

        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();


        $pk = $routeDispatcher->getParam("pk", false);
        $parentId = $routeDispatcher->getParam("parentId", false);
        switch ($currentItemName) {
            case "holidayDatesNew_screen":
                if ($parentId) {
                    $calendarMapper = new \IvozProvider\Mapper\Sql\Calendars();
                    $calendarModel = $calendarMapper->find($parentId);
                    $this->_condition[] = "`companyId` = '".$calendarModel->getCompanyId()."'";
                }
                break;
            case "holidayDatesEdit_screen":
                if ($pk) {
                    $holidayMapper = new \IvozProvider\Mapper\Sql\HolidayDates();
                    $holidayModel = $holidayMapper->find($pk);
                    $calendarModel = $holidayModel->getCalendar();
                    $companyId = $calendarModel->getCompanyId();
                    $this->_condition[] = "`companyId` = '".$companyId."'";
                }
                break;
        }

        return true;
    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return ['(' . implode(" AND ", $this->_condition) . ')'];
        }
        return;
    }

}
