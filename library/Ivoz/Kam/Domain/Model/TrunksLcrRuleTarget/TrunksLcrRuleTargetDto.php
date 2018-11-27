<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

class TrunksLcrRuleTargetDto extends TrunksLcrRuleTargetDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'lcrId' => 'lcrId',
                'priority' => 'priority',
                'weight' => 'weight',
                'id' => 'id',
                'ruleId' => 'rule',
                'gwId' => 'gw',
                'outgoingRoutingId' => 'outgoingRouting'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
