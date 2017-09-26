<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelBrand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class FeaturesRelBrandDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $featureId;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var mixed
     */
    private $feature;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'id' => $this->getId(),
            'brandId' => $this->getBrandId(),
            'featureId' => $this->getFeatureId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->feature = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Feature\\Feature', $this->getFeatureId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $id
     *
     * @return FeaturesRelBrandDTO
     */
    public function setId($id)
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
     * @param integer $brandId
     *
     * @return FeaturesRelBrandDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $featureId
     *
     * @return FeaturesRelBrandDTO
     */
    public function setFeatureId($featureId)
    {
        $this->featureId = $featureId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFeatureId()
    {
        return $this->featureId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Feature\Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }
}

