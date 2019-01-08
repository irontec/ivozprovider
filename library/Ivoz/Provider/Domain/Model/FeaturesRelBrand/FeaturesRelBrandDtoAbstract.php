<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class FeaturesRelBrandDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Feature\FeatureDto | null
     */
    private $feature;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'brandId' => 'brand',
            'featureId' => 'feature'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'feature' => $this->getFeature()
        ];
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureDto $feature
     *
     * @return static
     */
    public function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureDto $feature = null)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureDto
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFeatureId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Feature\FeatureDto($id)
            : null;

        return $this->setFeature($value);
    }

    /**
     * @return integer | null
     */
    public function getFeatureId()
    {
        if ($dto = $this->getFeature()) {
            return $dto->getId();
        }

        return null;
    }
}
