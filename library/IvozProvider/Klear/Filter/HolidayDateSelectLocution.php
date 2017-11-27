<?php

class IvozProvider_Klear_Filter_HolidayDateSelectLocution implements KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition = array();

    public function setRouteDispatcher(KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {
        //Get ModelName and your Controller
        $currentItemName = $routeDispatcher->getCurrentItemName();

        $pk = $routeDispatcher->getParam("pk", false);
        $parentId = $routeDispatcher->getParam("parentId", false);

        $dataGateway = \Zend_Registry::get('data_gateway');
        switch ($currentItemName) {
            case "holidayDatesNew_screen":
                if ($parentId) {

                    /**
                     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarDTO $calendarModel
                     */
                    $calendarModel = $dataGateway->find(
                        \Ivoz\Provider\Domain\Model\Calendar\Calendar::class,
                        $parentId
                    );
                    $this->_condition[] = "self::company = '" . $calendarModel->getCompanyId() . "'";
                }
                break;
            case "holidayDatesEdit_screen":
                if ($pk) {
                    /**
                     * @var \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDTO $holidayModel
                     */
                    $holidayModel = $dataGateway->find(
                        \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate::class,
                        $pk
                    );

                    /**
                     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarDTO $calendarModel
                     */
                    $calendarModel = $dataGateway->find(
                        \Ivoz\Provider\Domain\Model\Calendar\Calendar::class,
                        $holidayModel->getCalendarId()
                    );

                    $companyId = $calendarModel->getCompanyId();
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
