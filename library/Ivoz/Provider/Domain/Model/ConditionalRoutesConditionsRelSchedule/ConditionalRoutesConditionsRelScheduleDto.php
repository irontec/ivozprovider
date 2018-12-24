<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

class ConditionalRoutesConditionsRelScheduleDto extends ConditionalRoutesConditionsRelScheduleDtoAbstract
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
                'conditionId' => 'condition',
                'scheduleId' => 'schedule'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
