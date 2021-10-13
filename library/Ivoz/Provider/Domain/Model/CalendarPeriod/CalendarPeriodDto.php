<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

class CalendarPeriodDto extends CalendarPeriodDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'startDate' => 'startDate',
                'endDate' => 'endDate',
                'routeType' => 'routeType',
            ];
        }
        $response = parent::getPropertyMap($context, $role);

        return $response;
    }
}
