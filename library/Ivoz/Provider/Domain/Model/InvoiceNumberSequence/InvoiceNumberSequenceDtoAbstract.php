<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class InvoiceNumberSequenceDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $iden;

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var integer
     */
    private $sequenceLength;

    /**
     * @var integer
     */
    private $increment;

    /**
     * @var string
     */
    private $latestValue = '';

    /**
     * @var integer
     */
    private $iteration = 0;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;


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
            'iden' => 'iden',
            'prefix' => 'prefix',
            'sequenceLength' => 'sequenceLength',
            'increment' => 'increment',
            'latestValue' => 'latestValue',
            'iteration' => 'iteration',
            'version' => 'version',
            'id' => 'id',
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'iden' => $this->getIden(),
            'prefix' => $this->getPrefix(),
            'sequenceLength' => $this->getSequenceLength(),
            'increment' => $this->getIncrement(),
            'latestValue' => $this->getLatestValue(),
            'iteration' => $this->getIteration(),
            'version' => $this->getVersion(),
            'id' => $this->getId(),
            'brand' => $this->getBrand()
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
     * @param string $iden
     *
     * @return static
     */
    public function setIden($iden = null)
    {
        $this->iden = $iden;

        return $this;
    }

    /**
     * @return string
     */
    public function getIden()
    {
        return $this->iden;
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param integer $sequenceLength
     *
     * @return static
     */
    public function setSequenceLength($sequenceLength = null)
    {
        $this->sequenceLength = $sequenceLength;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSequenceLength()
    {
        return $this->sequenceLength;
    }

    /**
     * @param integer $increment
     *
     * @return static
     */
    public function setIncrement($increment = null)
    {
        $this->increment = $increment;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIncrement()
    {
        return $this->increment;
    }

    /**
     * @param string $latestValue
     *
     * @return static
     */
    public function setLatestValue($latestValue = null)
    {
        $this->latestValue = $latestValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getLatestValue()
    {
        return $this->latestValue;
    }

    /**
     * @param integer $iteration
     *
     * @return static
     */
    public function setIteration($iteration = null)
    {
        $this->iteration = $iteration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIteration()
    {
        return $this->iteration;
    }

    /**
     * @param integer $version
     *
     * @return static
     */
    public function setVersion($version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
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
}


