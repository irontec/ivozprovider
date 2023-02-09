<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

class HolidayDateDto extends HolidayDateDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'eventDate' => 'eventDate',
                'locutionId' => 'locution',
                'wholeDayEvent' => 'wholeDayEvent',
                'timeIn' => 'timeIn',
                'timeOut' => 'timeOut',
                'routeType' => 'routeType',
                'numberCountryId' => 'numberCountry',
                'numberValue' => 'numberValue',
                'calendarId' => 'calendar',
                'extensionId' => 'extension',
                'voicemailId' => 'voicemail',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
