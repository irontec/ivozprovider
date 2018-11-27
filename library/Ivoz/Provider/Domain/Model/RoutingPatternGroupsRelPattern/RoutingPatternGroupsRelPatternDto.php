<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

class RoutingPatternGroupsRelPatternDto extends RoutingPatternGroupsRelPatternDtoAbstract
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
                'routingPatternId' => 'routingPattern',
                'routingPatternGroupId' => 'routingPatternGroup'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
