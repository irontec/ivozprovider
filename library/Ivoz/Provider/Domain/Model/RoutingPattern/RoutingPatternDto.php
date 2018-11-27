<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

class RoutingPatternDto extends RoutingPatternDtoAbstract
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
                'prefix' => 'prefix',
                'name' => ['en','es']
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
