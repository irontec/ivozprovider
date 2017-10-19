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

        $dataGateway = \Zend_Registry::get('data_gateway');
        switch ($currentItemName) {
            case "holidayDatesNew_screen":
                if ($parentId) {

                    /**
                     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendarModel
                     */
                    $calendarModel = $dataGateway->find(
                        '\Ivoz\Provider\Domain\Model\Calendar\Calendar',
                        $parentId
                    );
                    $this->_condition[] = "self::company = '" . $calendarModel->getCompany()->getId() . "'";
                }
                break;
            case "holidayDatesEdit_screen":
                if ($pk) {
                    /**
                     * @var \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayModel
                     */
                    $holidayModel = $dataGateway->find(
                        '\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate',
                        $pk
                    );

                    $calendarModel = $holidayModel->getCalendar();
                    $companyId = $calendarModel->getCompany()->getId();
                    $this->_condition[] = "self::company = '".$companyId."'";
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
