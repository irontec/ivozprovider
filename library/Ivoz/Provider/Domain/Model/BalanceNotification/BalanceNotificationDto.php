<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

class BalanceNotificationDto extends BalanceNotificationDtoAbstract
{

    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'toAddress' => 'toAddress',
                'threshold' => 'threshold',
            ];
        }

        return [
            'toAddress' => 'toAddress',
            'threshold' => 'threshold',
            'lastSent' => 'lastSent',
            'id' => 'id',
            'companyId' => 'company',
            'notificationTemplateId' => 'notificationTemplate'
        ];
    }
}


