<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

class TransformationRuleSetDto extends TransformationRuleSetDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'description' => 'description',
                'internationalCode' => 'internationalCode',
                'trunkPrefix' => 'trunkPrefix',
                'areaCode' => 'areaCode',
                'nationalLen' => 'nationalLen',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
