<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

class BillableCallDto extends BillableCallDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
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
                'callid' => 'callid',
                'brandId' => 'brand',
                'companyId' => 'company',
                'carrierId' => 'carrier',
                'invoiceId' => 'invoice',
                'endpointType' => 'endpointType',
                'endpointId' => 'endpointId',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
