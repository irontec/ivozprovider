<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

class LcrGatewayDto extends LcrGatewayDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'lcrId' => 'lcrId',
                'gwName' => 'gwName',
                'ip' => 'ip',
                'hostname' => 'hostname'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
