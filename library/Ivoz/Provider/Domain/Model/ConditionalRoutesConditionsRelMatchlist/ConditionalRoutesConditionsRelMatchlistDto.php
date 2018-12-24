<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

class ConditionalRoutesConditionsRelMatchlistDto extends ConditionalRoutesConditionsRelMatchlistDtoAbstract
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
                'matchlistId' => 'matchlist'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
