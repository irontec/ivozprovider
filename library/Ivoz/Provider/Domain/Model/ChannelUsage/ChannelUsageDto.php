<?php

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

class ChannelUsageDto extends ChannelUsageDtoAbstract
{
    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'timestamp' => 'timestamp',
                'peak' => 'peak',
                'avgUsage' => 'avgUsage',
                'closingUsage' => 'closingUsage',
                'maxCallsCompany' => 'maxCallsCompany',
                'maxCallsBrand' => 'maxCallsBrand',
                'blockedByCompanyLimit' => 'blockedByCompanyLimit',
                'blockedByBrandLimit' => 'blockedByBrandLimit',
                'id' => 'id',
                'brandId' => 'brand',
                'companyId' => 'company'
            ];
        } else {
            $response = parent::getPropertyMap($context, $role);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

    /**
     * @param array<array-key, mixed> $response
     * @return array<array-key, mixed>
     */
    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'timestamp',
            'peak',
            'avgUsage',
            'maxCallsCompany',
            'blockedByCompanyLimit',
            'id',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
