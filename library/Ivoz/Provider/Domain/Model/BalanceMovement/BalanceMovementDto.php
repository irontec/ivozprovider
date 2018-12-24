<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

class BalanceMovementDto extends BalanceMovementDtoAbstract
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
