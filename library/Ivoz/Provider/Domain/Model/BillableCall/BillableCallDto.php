<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

class BillableCallDto extends BillableCallDtoAbstract
{
    const CONTEXT_RATING = 'rating';
    const CONTEXT_RATING_INTERNAL = 'rating-internal';

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_RATING_INTERNAL) {
            return [
                'price' => 'price',
                'cost' => 'cost',
                'destinationName' => 'destinationName',
                'destinationId' => 'destination',
                'ratingPlanName' => 'ratingPlanName',
                'ratingPlanGroupId' => 'ratingPlanGroup',
            ];
        }

        if ($context === self::CONTEXT_RATING) {
            return [
                'price' => 'price',
                'cost' => 'cost',
                'destinationName' => 'destinationName',
                'ratingPlanName' => 'ratingPlanName'
            ];
        }

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
                'ddiProviderId' => 'ddiProvider',
                'invoiceId' => 'invoice',
                'endpointType' => 'endpointType',
                'endpointId' => 'endpointId',
                'endpointName' => 'endpointName',
                'ddiId' => 'ddi'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_SUPER_ADMIN') {
            unset($response['destinationId']);
            unset($response['ratingPlanGroupId']);
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
            'endpointName',
            'direction',
            'id',
            'companyId',
            'carrierId',
            'ddiProviderId',
            'destinationId',
            'ratingPlanGroupId',
            'invoiceId',
            'ddiId'
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
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
            'endpointName',
            'direction',
            'id',
            'ddiId',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
