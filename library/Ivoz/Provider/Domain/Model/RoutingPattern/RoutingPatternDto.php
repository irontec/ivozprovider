<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

class RoutingPatternDto extends RoutingPatternDtoAbstract
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
                'name' => ['en','es']
            ];
        }

        $response =  parent::getPropertyMap(...func_get_args());

        // Remove application entity relation
        unset($response['tpDestinationId']);

        return $response;
    }
}


