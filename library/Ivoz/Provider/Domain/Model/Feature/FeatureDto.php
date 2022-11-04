<?php

namespace Ivoz\Provider\Domain\Model\Feature;

class FeatureDto extends FeatureDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'iden' => 'iden',
                'name' => [
                    'en',
                    'es',
                    'ca',
                    'it',
                ],
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
