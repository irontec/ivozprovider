<?php

namespace Ivoz\Provider\Domain\Model\GenericCallAclPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class GenericCallAclPatternDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $regExp;

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
    private $brand;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'regExp' => $this->getRegExp(),
            'id' => $this->getId(),
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
     * @param string $name
     *
     * @return GenericCallAclPatternDTO
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $regExp
     *
     * @return GenericCallAclPatternDTO
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
     * @return GenericCallAclPatternDTO
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
     * @return GenericCallAclPatternDTO
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


