<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

class OutgoingDdiRulesPatternDto extends OutgoingDdiRulesPatternDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'action' => 'action',
                'priority' => 'priority',
                'id' => 'id',
                'outgoingDdiRuleId' => 'outgoingDdiRule',
                'matchListId' => 'matchList',
                'forcedDdiId' => 'forcedDdi'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
