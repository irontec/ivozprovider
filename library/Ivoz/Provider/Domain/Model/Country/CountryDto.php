<?php

namespace Ivoz\Provider\Domain\Model\Country;

class CountryDto extends CountryDtoAbstract
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
                'code' => 'code',
                'countryCode' => 'countryCode',
                'name' => ['en', 'es']
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
