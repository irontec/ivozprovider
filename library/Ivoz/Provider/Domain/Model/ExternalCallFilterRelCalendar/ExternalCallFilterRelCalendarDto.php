<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

class ExternalCallFilterRelCalendarDto extends ExternalCallFilterRelCalendarDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'filterId' => 'filter',
                'calendarId' => 'calendar'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
