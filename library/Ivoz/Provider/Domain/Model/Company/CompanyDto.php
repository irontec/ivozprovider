<?php

namespace Ivoz\Provider\Domain\Model\Company;

class CompanyDto extends CompanyDtoAbstract
{
    public function denormalize(array $data, string $context, string $role = '')
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $data = $this->filterCompanyReadOnlyFields($data);
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $data = $this->filterBrandReadOnlyFields($data);
        }

        return parent::denormalize($data, $context, $role);
    }

    private function filterCompanyReadOnlyFields(array $data): array
    {
        $readOnlyFlds = [
            'name',
            'domainUsers',
            'nif',
            'onDemandRecordCode',
            'balance'
        ];

        foreach ($readOnlyFlds as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        return $data;
    }

    private function filterBrandReadOnlyFields(array $data): array
    {
        $readOnlyFlds = [
            'balance',
        ];

        foreach ($readOnlyFlds as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        return $data;
    }

    /**
     * @codeCoverageIgnore
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'nif' => 'nif'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        unset($response['domainId']);
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
            'type',
            'name',
            'domainUsers',
            'nif',
            'maxCalls',
            'postalAddress',
            'postalCode',
            'town',
            'province',
            'countryName',
            'ipfilter',
            'onDemandRecord',
            'onDemandRecordCode',
            'externallyextraopts',
            'billingMethod',
            'balance',
            'showInvoices',
            'id',
            'languageId',
            'brandId',
            'defaultTimezoneId',
            'countryId',
            'currencyId',
            'transformationRuleSetId',
            'outgoingDdiId',
            'outgoingDdiRuleId',
            'voicemailNotificationTemplateId',
            'faxNotificationTemplateId',
            'invoiceNotificationTemplateId',
            'callCsvNotificationTemplateId'
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
            'type',
            'name',
            'domainUsers',
            'nif',
            'onDemandRecordCode',
            'balance',
            'id',
            'languageId',
            'defaultTimezoneId',
            'countryId',
            'transformationRuleSetId',
            'outgoingDdiId',
            'outgoingDdiRuleId',
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
