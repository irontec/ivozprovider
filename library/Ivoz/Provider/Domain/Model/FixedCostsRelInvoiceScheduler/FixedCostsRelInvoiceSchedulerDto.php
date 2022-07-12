<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

class FixedCostsRelInvoiceSchedulerDto extends FixedCostsRelInvoiceSchedulerDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'quantity' => 'quantity',
            'id' => 'id',
            'type' => 'type',
            'ddisCountryMatch' => 'ddisCountryMatch',
            'ddisCountry' => 'ddisCountry',
            'fixedCostId' => 'fixedCost',
            'invoiceSchedulerId' => 'invoiceScheduler'
        ];
    }
}
