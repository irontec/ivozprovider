<?php

namespace Ivoz\Provider\Domain\Model\PeeringContract;

class PeeringContractDto extends PeeringContractDtoAbstract
{
    /**
     * @inheritdoc
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


