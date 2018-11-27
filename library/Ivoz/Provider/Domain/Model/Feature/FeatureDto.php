<?php

namespace Ivoz\Provider\Domain\Model\Feature;

class FeatureDto extends FeatureDtoAbstract
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
                'iden' => 'iden'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
