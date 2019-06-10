<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

class RetailAccountDto extends RetailAccountDtoAbstract
{
    /**
     * @codeCoverageIgnore
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $role = null)
    {
        $response = parent::getPropertyMap($context);

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
            'name',
            'description',
            'transport',
            'ip',
            'port',
            'password',
            'fromDomain',
            'directConnectivity',
            'ddiIn',
            't38Passthrough',
            'id',
            'brandId',
            'companyId',
            'transformationRuleSetId',
            'outgoingDdiId'
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
            'name',
            'description',
            'id',
            'transformationRuleSetId',
            'outgoingDdiId'
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
