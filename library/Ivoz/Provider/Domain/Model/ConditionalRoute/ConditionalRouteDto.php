<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

class ConditionalRouteDto extends ConditionalRouteDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'routetype' => 'routetype'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
