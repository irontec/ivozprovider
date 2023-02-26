<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandDto;

class BrandDto extends BrandDtoAbstract
{
    public const CONTEXT_WITH_FEATURES = 'withFeatures';
    public const CONTEXT_WITH_PROXY_TRUNKS = 'withProxyTrunks';

    public const CONTEXTS_WITH_FEATURES = [
        self::CONTEXT_WITH_FEATURES,
        self::CONTEXT_DETAILED,
        self::CONTEXT_COLLECTION
    ];

    public const CONTEXTS_WITH_PROXY_TRUNKS = [
        self::CONTEXT_WITH_PROXY_TRUNKS,
        self::CONTEXT_DETAILED,
        self::CONTEXT_COLLECTION
    ];

    /** @var ?string */
    private $logoPath;

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Active feature ids"
     * )
     */
    private $features = [];


    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Active proxyTrunks ids"
     * )
     */
    private $proxyTrunks = [];

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    public function getFileObjects(): array
    {
        return [
            'logo'
        ];
    }

    /**
     * @return self
     */
    public function setLogoPath(string $path = null)
    {
        $this->logoPath = $path;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = self::CONTEXT_COLLECTION, string $role = null): array
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            return [];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'invoice' => ['nif', 'postalCode'],
                'logo' => ['fileSize','mimeType','baseName'],
                'domainUsers' => 'domainUsers',
                'features' => 'features',
                'proxyTrunks' => 'proxyTrunks'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['features'] = 'features';
        }

        if (in_array($context, self::CONTEXTS_WITH_PROXY_TRUNKS, true)) {
            $response['proxyTrunks'] = 'proxyTrunks';
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $response = self::filterFieldsForBrandAdmin($response);
        }

        unset($response['recordingsLimitMB']);
        unset($response['recordingsLimitEmail']);
        unset($response['domainId']);

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);

        if ($context === self::CONTEXT_SIMPLE) {
            $contextProperties['logo'][] = 'path';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['features'] = $this->features;
        }

        if (in_array($context, self::CONTEXTS_WITH_PROXY_TRUNKS, true)) {
            $response['proxyTrunks'] = $this->proxyTrunks;
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
            'id',
            'name',
            'logo',
            'invoice',
            'languageId',
            'defaultTimezoneId',
            'currencyId',
            'voicemailNotificationTemplateId',
            'faxNotificationTemplateId',
            'invoiceNotificationTemplateId',
            'callCsvNotificationTemplateId',
            'maxDailyUsageNotificationTemplateId',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @param int[] $featureIds
     *
     * @return void
     */
    public function setFeatures(array $featureIds): void
    {
        $this->features = $featureIds;

        $relFeatures = [];
        foreach ($featureIds as $id) {
            $dto = new FeaturesRelBrandDto();
            $dto->setFeatureId($id);
            $relFeatures[] = $dto;
        }

        $this->setRelFeatures($relFeatures);
    }

    /**
     * @param int[] $proxyTrunksIds
     *
     * @return void
     */
    public function setProxyTrunks(array $proxyTrunksIds): void
    {
        $this->proxyTrunks = $proxyTrunksIds;

        $relProxyTrunks = [];
        foreach ($proxyTrunksIds as $id) {
            $dto = new ProxyTrunksRelBrandDto();
            $dto->setProxyTrunkId($id);
            $relProxyTrunks[] = $dto;
        }

        $this->setRelProxyTrunks($relProxyTrunks);
    }
}
