<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class GenericMusicOnHoldDTO implements DataTransferObjectInterface
{
    use GenericMusicOnHoldDTOTrait;
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $originalFileFileSize;

    /**
     * @var string
     */
    private $originalFileMimeType;

    /**
     * @var string
     */
    private $originalFileBaseName;

    /**
     * @var integer
     */
    private $encodedFileFileSize;

    /**
     * @var string
     */
    private $encodedFileMimeType;

    /**
     * @var string
     */
    private $encodedFileBaseName;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $brand;

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
     * @return GenericMusicOnHoldDTO
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
     * @param string $status
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $id
     *
     * @return GenericMusicOnHoldDTO
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
     * @param integer $originalFileFileSize
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setOriginalFileFileSize($originalFileFileSize)
    {
        $this->originalFileFileSize = $originalFileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOriginalFileFileSize()
    {
        return $this->originalFileFileSize;
    }

    /**
     * @param string $originalFileMimeType
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setOriginalFileMimeType($originalFileMimeType)
    {
        $this->originalFileMimeType = $originalFileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileMimeType()
    {
        return $this->originalFileMimeType;
    }

    /**
     * @param string $originalFileBaseName
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setOriginalFileBaseName($originalFileBaseName)
    {
        $this->originalFileBaseName = $originalFileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileBaseName()
    {
        return $this->originalFileBaseName;
    }

    /**
     * @param integer $encodedFileFileSize
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setEncodedFileFileSize($encodedFileFileSize)
    {
        $this->encodedFileFileSize = $encodedFileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getEncodedFileFileSize()
    {
        return $this->encodedFileFileSize;
    }

    /**
     * @param string $encodedFileMimeType
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setEncodedFileMimeType($encodedFileMimeType)
    {
        $this->encodedFileMimeType = $encodedFileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedFileMimeType()
    {
        return $this->encodedFileMimeType;
    }

    /**
     * @param string $encodedFileBaseName
     *
     * @return GenericMusicOnHoldDTO
     */
    public function setEncodedFileBaseName($encodedFileBaseName)
    {
        $this->encodedFileBaseName = $encodedFileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedFileBaseName()
    {
        return $this->encodedFileBaseName;
    }

    /**
     * @param integer $brandId
     *
     * @return GenericMusicOnHoldDTO
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


