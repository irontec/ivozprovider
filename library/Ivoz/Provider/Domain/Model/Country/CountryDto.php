<?php

namespace Ivoz\Provider\Domain\Model\Country;

class CountryDto extends CountryDtoAbstract
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
                'code' => 'code',
                'countryCode' => 'countryCode',
                'name' => ['en', 'es','ca','it']
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
