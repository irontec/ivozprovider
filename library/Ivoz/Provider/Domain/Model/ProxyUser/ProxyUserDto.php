<?php

namespace Ivoz\Provider\Domain\Model\ProxyUser;

class ProxyUserDto extends ProxyUserDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'ip' => 'ip',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
