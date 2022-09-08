<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

class BalanceMovementDto extends BalanceMovementDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'amount' => 'amount',
                'balance' => 'balance',
                'createdOn' => 'createdOn',
                'id' => 'id',
                'companyId' => 'company',
                'carrierId' => 'carrier'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
