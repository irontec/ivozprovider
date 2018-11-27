<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

class DdiDto extends DdiDtoAbstract
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
                'ddi' => 'ddi',
                'ddie164' => 'ddie164',
                'routeType' => 'routeType'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
