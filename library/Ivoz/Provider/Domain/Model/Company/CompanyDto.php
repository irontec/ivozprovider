<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecDto;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryDto;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagDto;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyDto;

class CompanyDto extends CompanyDtoAbstract
{
    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Active feature ids"
     * )
     */
    private $featureIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Country ids"
     * )
     */
    private $geoIpAllowedCountries = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Routing tag ids"
     * )
     */
    private $routingTagIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Codec ids"
     * )
     */
    private $codecIds = [];

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if ($role === 'ROLE_BRAND_ADMIN') {
            $response['featureIds'] = $this->featureIds;
            $response['geoIpAllowedCountries'] = $this->geoIpAllowedCountries;
            $response['routingTagIds'] = $this->routingTagIds;
            $response['codecIds'] = $this->codecIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
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
    public function setFeatureIds(array $featureIds): self
    {
        $this->featureIds = $featureIds;
        $relFeatures = [];
        foreach ($featureIds as $id) {
            $dto = new FeaturesRelCompanyDto();
            $dto->setFeatureId($id);
            $relFeatures[] = $dto;
        }
        $this->setRelFeatures($relFeatures);

        return $this;
    }

    /**
     * @param int[] $geoIpAllowedCountries
     */
    public function setGeoIpAllowedCountries(array $geoIpAllowedCountries): self
    {
        $this->geoIpAllowedCountries = $geoIpAllowedCountries;
        $relCountries = [];
        foreach ($geoIpAllowedCountries as $id) {
            $dto = new CompanyRelGeoIPCountryDto();
            $dto->setCountryId($id);
            $relCountries[] = $dto;
        }
        $this->setRelCountries($relCountries);

        return $this;
    }

    /**
     * @param int[] $routingTagIds
     */
    public function setRoutingTagIds(array $routingTagIds): self
    {
        $this->routingTagIds = $routingTagIds;
        $relRoutingTags = [];
        foreach ($routingTagIds as $id) {
            $dto = new CompanyRelRoutingTagDto();
            $dto->setRoutingTagId($id);
            $relRoutingTags[] = $dto;
        }
        $this->setRelRoutingTags($relRoutingTags);

        return $this;
    }

    /**
     * @param int[] $codecIds
     */
    public function setCodecIds(array $codecIds): self
    {
        $this->routingTagIds = $codecIds;
        $relCodecs = [];
        foreach ($codecIds as $id) {
            $dto = new CompanyRelCodecDto();
            $dto->setCodecId($id);
            $relCodecs[] = $dto;
        }
        $this->setRelCodecs($relCodecs);

        return $this;
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
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'type' => 'type',
                'nif' => 'nif',
                'billingMethod' => 'billingMethod',
                'currentDayUsage' => 'currentDayUsage',
                'maxDailyUsage' => 'maxDailyUsage',
            ];

            if ($role === 'ROLE_BRAND_ADMIN') {
                $response['domainUsers'] = 'domainUsers';
                $response['balance'] = 'balance';
                $response['outgoingDdiId'] = 'outgoingDdi';
            }
        } else {
            $response = parent::getPropertyMap($context);
        }

        unset($response['domainId']);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $response['featureIds'] = 'featureIds';
            $response['geoIpAllowedCountries'] = 'geoIpAllowedCountries';
            $response['routingTagIds'] = 'routingTagIds';
            $response['codecIds'] = 'codecIds';

            return self::filterFieldsForBrandAdmin($response);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

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
            'allowRecordingRemoval',
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
            'geoIpAllowedCountries',
            'routingTagIds',
            'codecIds',
            'maxDailyUsage',
            'maxDailyUsageEmail',
            'maxDailyUsageNotificationTemplateId',
            'currentDayUsage' => 'currentDayUsage',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

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
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
