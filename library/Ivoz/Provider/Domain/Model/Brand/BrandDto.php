<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandDto;

class BrandDto extends BrandDtoAbstract
{
    const CONTEXT_WITH_FEATURES = 'withFeatures';

    const CONTEXTS_WITH_FEATURES = [
        self::CONTEXT_WITH_FEATURES,
        self::CONTEXT_DETAILED
    ];

    private $logoPath;

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Active feature ids"
     * )
     */
    protected $featureIds = [];

    public function getFileObjects()
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
     * @return string
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = self::CONTEXT_COLLECTION, string $role = null)
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            return [];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['features'] = 'features';
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $response = self::filterFieldsForBrandAdmin($response);
        }

        $response['logoPath'] = 'logoPath';
        unset($response['recordingsLimitMB']);
        unset($response['recordingsLimitEmail']);
        unset($response['domainId']);

        return $response;
    }

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_FEATURES, true)) {
            $response['features'] = $this->featureIds;
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
     * @param int[] $featureIds
     */
    public function setFeatures(array $featureIds)
    {
        $this->featureIds = $featureIds;

        $relFeatures = [];
        foreach ($featureIds as $id) {
            $dto = new FeaturesRelBrandDto();
            $dto->setFeatureId($id);
            $relFeatures[] = $dto;
        }

        $this->setRelFeatures($relFeatures);
    }
}
