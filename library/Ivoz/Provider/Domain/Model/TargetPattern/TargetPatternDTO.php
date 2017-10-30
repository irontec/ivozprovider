<?php

namespace Ivoz\Provider\Domain\Model\TargetPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TargetPatternDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $regExp;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $descriptionEn;

    /**
     * @var string
     */
    private $descriptionEs;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'regExp' => $this->getRegExp(),
            'id' => $this->getId(),
            'nameEn' => $this->getNameEn(),
            'nameEs' => $this->getNameEs(),
            'descriptionEn' => $this->getDescriptionEn(),
            'descriptionEs' => $this->getDescriptionEs(),
            'brandId' => $this->getBrandId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $regExp
     *
     * @return TargetPatternDTO
     */
    public function setRegExp($regExp)
    {
        $this->regExp = $regExp;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegExp()
    {
        return $this->regExp;
    }

    /**
     * @param integer $id
     *
     * @return TargetPatternDTO
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
     * @param string $nameEn
     *
     * @return TargetPatternDTO
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return TargetPatternDTO
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $descriptionEn
     *
     * @return TargetPatternDTO
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs
     *
     * @return TargetPatternDTO
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * @param integer $brandId
     *
     * @return TargetPatternDTO
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
}


