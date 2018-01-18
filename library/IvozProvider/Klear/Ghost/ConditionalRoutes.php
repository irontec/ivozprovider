<?php

use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;

class IvozProvider_Klear_Ghost_ConditionalRoutes extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param $model \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto
     * @return concatenated names of match data
     */
    public function getMatchData($model)
    {
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');
        $matchData = [];

        $matchListRels = $dataGateway->remoteProcedureCall(
            ConditionalRoutesCondition::class,
            $model->getId(),
            'getMatchLists',
            []
        );
        foreach ($matchListRels as $matchList) {
            $matchData[] = $matchList->getName();
        }

        $scheduleRels = $dataGateway->remoteProcedureCall(
            ConditionalRoutesCondition::class,
            $model->getId(),
            'getSchedules',
            []
        );
        foreach ($scheduleRels as $schedule) {
            $matchData[] = $schedule->getName();
        }

        $calendarRels = $dataGateway->remoteProcedureCall(
            ConditionalRoutesCondition::class,
            $model->getId(),
            'getCalendars',
            []
        );
        foreach ($calendarRels as $calendar) {
            $matchData[] = $calendar->getName();
        }

        return implode(",", $matchData);
    }

}
