<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

class CalendarPeriodsRelScheduleDto extends CalendarPeriodsRelScheduleDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_DETAILED_COLLECTION) {
            return [
                'id' => 'id',
                'calendarPeriodId' => 'calendarPeriod',
                'scheduleId' => 'schedule'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
