<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

class ConditionalRoutesConditionDto extends ConditionalRoutesConditionDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'priority' => 'priority',
                'routeType' => 'routeType'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
