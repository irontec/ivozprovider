<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

class TrunksLcrGatewayDto extends TrunksLcrGatewayDtoAbstract
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
                'lcrId' => 'lcrId',
                'gwName' => 'gwName',
                'ip' => 'ip',
                'hostname' => 'hostname'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
