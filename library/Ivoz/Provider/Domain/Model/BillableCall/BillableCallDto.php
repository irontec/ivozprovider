<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

class BillableCallDto extends BillableCallDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'startTime' => 'startTime',
                'duration' => 'duration',
                'caller' => 'caller',
                'callee' => 'callee',
                'cost' => 'cost',
                'price' => 'price',
                'id' => 'id',
                'brandId' => 'brand',
                'companyId' => 'company',
                'carrierId' => 'carrier',
                'invoiceId' => 'invoice'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
