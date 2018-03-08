<?php

namespace Ivoz\Provider\Domain\Model\LcrRule;

class LcrRuleDto extends LcrRuleDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'prefix' => 'prefix',
                'fromUri' => 'fromUri',
                'tag' => 'tag',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


