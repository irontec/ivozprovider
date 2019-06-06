<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

class RoutingTagDto extends RoutingTagDtoAbstract
{
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'TagName' => 'TagName'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
