<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

class ProxyTrunkDto extends ProxyTrunkDtoAbstract
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
                'name' => 'name',
                'ip' => 'ip',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
