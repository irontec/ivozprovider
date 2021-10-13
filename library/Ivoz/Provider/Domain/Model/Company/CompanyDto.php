<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyDto;

class CompanyDto extends CompanyDtoAbstract
{
    public const CONTEXT_WITH_FEATURES = 'withFeatures';

    public const CONTEXTS_WITH_FEATURES = [
        self::CONTEXT_WITH_FEATURES,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Active feature ids"
     * )
     */
    protected $featureIds = [];

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['featureIds'] = $this->featureIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $data = $this->filterCompanyReadOnlyFields($data);
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $data = $this->filterBrandReadOnlyFields($data);
        }

        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @param int[] $featureIds
     */
    public function setFeatureIds(array $featureIds)
    {
        $this->featureIds = $featureIds;
        $relFeatures = [];
        foreach ($featureIds as $id) {
            $dto = new FeaturesRelCompanyDto();
            $dto->setFeatureId($id);
            $relFeatures[] = $dto;
        }
        $this->setRelFeatures($relFeatures);
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
                'type' => 'type',
                'nif' => 'nif'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['featureIds'] = 'featureIds';
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
            'defaultTimezoneId',
            'countryId',
            'currencyId',
            'transformationRuleSetId',
            'outgoingDdiId',
            'outgoingDdiRuleId',
            'voicemailNotificationTemplateId',
            'faxNotificationTemplateId',
            'invoiceNotificationTemplateId',
            'callCsvNotificationTemplateId',
            'featureIds',
            'maxDailyUsage',
            'maxDailyUsageEmail',
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

        return array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
