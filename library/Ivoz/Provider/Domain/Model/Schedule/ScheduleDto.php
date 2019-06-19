<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

class ScheduleDto extends ScheduleDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'timeIn' => 'timeIn',
                'timeout' => 'timeout',
                'monday' => 'monday',
                'tuesday' => 'tuesday',
                'wednesday' => 'wednesday',
                'thursday' => 'thursday',
                'friday' => 'friday',
                'saturday' => 'saturday',
                'sunday' => 'sunday',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
