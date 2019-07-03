<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

class BillableCallDto extends BillableCallDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'startTime' => 'startTime',
                'direction' => 'direction',
                'duration' => 'duration',
                'caller' => 'caller',
                'callee' => 'callee',
                'cost' => 'cost',
                'id' => 'id',
                'price' => 'price',
                'callid' => 'callid',
                'brandId' => 'brand',
                'companyId' => 'company',
                'carrierId' => 'carrier',
                'invoiceId' => 'invoice',
                'endpointType' => 'endpointType',
                'endpointId' => 'endpointId',
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            return self::filterFieldsForBrandAdmin($response);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }


    /**
     * @param array $response
     * @return array
     */
    private static function filterFieldsForBrandAdmin(array $response): array
    {
        $allowedFields = [
            'callid',
            'startTime',
            'duration',
            'caller',
            'callee',
            'cost',
            'price',
            'carrierName',
            'destinationName',
            'ratingPlanName',
            'endpointType',
            'endpointId',
            'direction',
            'id',
            'companyId',
            'carrierId',
            'destinationId',
            'ratingPlanGroupId',
            'invoiceId'
        ];

        $response = array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }

    /**
     * @param array $response
     * @return array
     */
    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'callid',
            'startTime',
            'duration',
            'caller',
            'callee',
            'price',
            'destinationName',
            'ratingPlanName',
            'endpointType',
            'endpointId',
            'direction',
            'id',
        ];

        $response = array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }
}
