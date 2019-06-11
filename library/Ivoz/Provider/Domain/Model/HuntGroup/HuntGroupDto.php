<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

class HuntGroupDto extends HuntGroupDtoAbstract
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
                'strategy' => 'strategy'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
