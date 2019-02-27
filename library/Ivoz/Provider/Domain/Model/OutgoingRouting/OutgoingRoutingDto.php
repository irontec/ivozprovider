<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

class OutgoingRoutingDto extends OutgoingRoutingDtoAbstract
{
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'type' => 'type',
                'priority' => 'priority',
                'weight' => 'weight',
                'routingMode' => 'routingMode',
                'companyId' => 'company',
                'routingTagId' => 'routingTag',
            ];
        }

        return parent::getPropertyMap($context);
    }
}
