<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandDto;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandDto;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandDto;

class BrandDto extends BrandDtoAbstract
{
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
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Application Server Set ids"
     * )
     */
    private $applicationServerSets = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Media Relay Set Ids"
     * )
     */
    private $mediaRelaySets = [];

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
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if ($context !== self::CONTEXT_SIMPLE) {
            $response['features'] = 'features';
            $response['proxyTrunks'] = 'proxyTrunks';
            $response['applicationServerSets'] = 'applicationServerSets';
            $response['mediaRelaySets'] = 'mediaRelaySets';
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

        if ($context === self::CONTEXT_DETAILED) {
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

        $response['features'] = $this->features;
        $response['proxyTrunks'] = $this->proxyTrunks;
        $response['applicationServerSets'] = $this->applicationServerSets;
        $response['mediaRelaySets'] = $this->mediaRelaySets;

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

    /**
     * @param int[] $relApplicationServerSetIds
     */
    public function setApplicationServerSets(array $relApplicationServerSetIds): void
    {
        $this->applicationServerSets = $relApplicationServerSetIds;

        $relApplicationServerSets = [];
        foreach ($relApplicationServerSetIds as $id) {
            $dto = new ApplicationServerSetsRelBrandDto();
            $dto->setApplicationServerSetId($id);
            $dto->setBrandId($this->getId());
            $relApplicationServerSets[] = $dto;
        }

        $this->setRelApplicationServerSets($relApplicationServerSets);
    }

    /**
     * @param int[] $relMediaRelaySetIds
     */
    public function setMediaRelaySets(array $relMediaRelaySetIds): void
    {
        $this->mediaRelaySets = $relMediaRelaySetIds;

        $relMediaRelaySets = [];
        foreach ($relMediaRelaySetIds as $id) {
            $dto = new MediaRelaySetsRelBrandDto();
            $dto->setMediaRelaySetId($id);
            $relMediaRelaySets[] = $dto;
        }

        $this->setRelMediaRelaySets($relMediaRelaySets);
    }
}
