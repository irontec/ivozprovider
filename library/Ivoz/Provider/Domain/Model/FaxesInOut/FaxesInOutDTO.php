<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class FaxesInOutDTO implements DataTransferObjectInterface
{
    /**
     * @var \DateTime
     */
    private $calldate;

    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $dst;

    /**
     * @var string
     */
    private $type = 'Out';

    /**
     * @var string
     */
    private $pages;

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
    private $fileFileSize;

    /**
     * @var string
     */
    private $fileMimeType;

    /**
     * @var string
     */
    private $fileBaseName;

    /**
     * @var mixed
     */
    private $faxId;

    /**
     * @var mixed
     */
    private $fax;

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->fax = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Fax\\Fax', $this->getFaxId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param \DateTime $calldate
     *
     * @return FaxesInOutDTO
     */
    public function setCalldate($calldate)
    {
        $this->calldate = $calldate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * @param string $src
     *
     * @return FaxesInOutDTO
     */
    public function setSrc($src = null)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param string $dst
     *
     * @return FaxesInOutDTO
     */
    public function setDst($dst = null)
    {
        $this->dst = $dst;

        return $this;
    }

    /**
     * @return string
     */
    public function getDst()
    {
        return $this->dst;
    }

    /**
     * @param string $type
     *
     * @return FaxesInOutDTO
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $pages
     *
     * @return FaxesInOutDTO
     */
    public function setPages($pages = null)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param string $status
     *
     * @return FaxesInOutDTO
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
     * @return FaxesInOutDTO
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
     * @param integer $fileFileSize
     *
     * @return FaxesInOutDTO
     */
    public function setFileFileSize($fileFileSize)
    {
        $this->fileFileSize = $fileFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFileFileSize()
    {
        return $this->fileFileSize;
    }

    /**
     * @param string $fileMimeType
     *
     * @return FaxesInOutDTO
     */
    public function setFileMimeType($fileMimeType)
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileMimeType()
    {
        return $this->fileMimeType;
    }

    /**
     * @param string $fileBaseName
     *
     * @return FaxesInOutDTO
     */
    public function setFileBaseName($fileBaseName)
    {
        $this->fileBaseName = $fileBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileBaseName()
    {
        return $this->fileBaseName;
    }

    /**
     * @param integer $faxId
     *
     * @return FaxesInOutDTO
     */
    public function setFaxId($faxId)
    {
        $this->faxId = $faxId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFaxId()
    {
        return $this->faxId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Fax\Fax
     */
    public function getFax()
    {
        return $this->fax;
    }
}


