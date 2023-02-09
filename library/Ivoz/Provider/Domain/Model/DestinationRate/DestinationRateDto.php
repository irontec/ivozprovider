<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

class DestinationRateDto extends DestinationRateDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'cost' => 'cost',
                'connectFee' => 'connectFee',
                'rateIncrement' => 'rateIncrement',
                'groupIntervalStart' => 'groupIntervalStart',
                'id' => 'id',
                'destinationRateGroupId' => 'destinationRateGroup',
                'destinationId' => 'destination'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
