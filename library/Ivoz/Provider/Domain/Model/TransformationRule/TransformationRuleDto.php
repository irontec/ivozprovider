<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

class TransformationRuleDto extends TransformationRuleDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'type' => 'type',
                'description' => 'description',
                'priority' => 'priority',
                'matchExpr' => 'matchExpr',
                'replaceExpr' => 'replaceExpr',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
