<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

class TrunksLcrRuleDto extends TrunksLcrRuleDtoAbstract
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
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
