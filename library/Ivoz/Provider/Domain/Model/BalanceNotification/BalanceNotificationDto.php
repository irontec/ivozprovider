<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

class BalanceNotificationDto extends BalanceNotificationDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'toAddress' => 'toAddress',
                'threshold' => 'threshold',
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
