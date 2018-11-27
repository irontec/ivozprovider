<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

class CarrierDto extends CarrierDtoAbstract
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
                'description' => 'description',
                'name' => 'name',
                'externallyRated' => 'externallyRated'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
