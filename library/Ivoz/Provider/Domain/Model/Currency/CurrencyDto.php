<?php

namespace Ivoz\Provider\Domain\Model\Currency;

class CurrencyDto extends CurrencyDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'iden' => 'iden',
                'symbol' => 'symbol',
                'id' => 'id',
                'name' => ['en','es']
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
