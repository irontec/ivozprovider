<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

class FixedCostsRelInvoiceDto extends FixedCostsRelInvoiceDtoAbstract
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
                'quantity' => 'quantity',
                'fixedCostId' => 'fixedCost',
                'invoiceId' => 'invoice'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
