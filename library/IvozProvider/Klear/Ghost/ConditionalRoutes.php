<?php

class IvozProvider_Klear_Ghost_ConditionalRoutes extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     * @param $model ConditionalRoutesCondition
     * @return concatenated names of match data
     */
    public function getMatchData ($model)
    {
        $matchData = [];

        $matchListRels = $model->getMatchLists() ?? [];
        foreach ($matchListRels as $matchListRel) {
            $matchData[] = $matchListRel->getMatchList()->getName();
        }

        $scheduleRels = $model->getSchedules() ?? [];
        foreach ($scheduleRels as $scheduleRel) {
            $matchData[] = $scheduleRel->getSchedule()->getName();
        }

        $calendarRels = $model->getCalendars() ?? [];
        foreach ($calendarRels as $calendarRel) {
            $matchData[] = $calendarRel->getCalendar()->getName();
        }


        return implode(",", $matchData);
    }

}
