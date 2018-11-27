<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

class ExternalCallFilterRelScheduleDto extends ExternalCallFilterRelScheduleDtoAbstract
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
                'scheduleId' => 'schedule'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
