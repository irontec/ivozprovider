<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

class RoutingPatternGroupDto extends RoutingPatternGroupDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'description' => 'description',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
