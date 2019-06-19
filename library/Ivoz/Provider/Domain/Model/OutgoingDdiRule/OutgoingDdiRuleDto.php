<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

class OutgoingDdiRuleDto extends OutgoingDdiRuleDtoAbstract
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
                'name' => 'name',
                'defaultAction' => 'defaultAction'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
