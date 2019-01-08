<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class FaxesInOutDtoAbstract implements DataTransferObjectInterface
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
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxDto | null
     */
    private $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $dstCountry;


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
            'calldate' => 'calldate',
            'src' => 'src',
            'dst' => 'dst',
            'type' => 'type',
            'pages' => 'pages',
            'status' => 'status',
            'id' => 'id',
            'file' => ['fileSize','mimeType','baseName'],
            'faxId' => 'fax',
            'dstCountryId' => 'dstCountry'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'calldate' => $this->getCalldate(),
            'src' => $this->getSrc(),
            'dst' => $this->getDst(),
            'type' => $this->getType(),
            'pages' => $this->getPages(),
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'file' => [
                'fileSize' => $this->getFileFileSize(),
                'mimeType' => $this->getFileMimeType(),
                'baseName' => $this->getFileBaseName()
            ],
            'fax' => $this->getFax(),
            'dstCountry' => $this->getDstCountry()
        ];
    }

    /**
     * @param \DateTime $calldate
     *
     * @return static
     */
    public function setCalldate($calldate = null)
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @param integer $fileFileSize
     *
     * @return static
     */
    public function setFileFileSize($fileFileSize = null)
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
     * @return static
     */
    public function setFileMimeType($fileMimeType = null)
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
     * @return static
     */
    public function setFileBaseName($fileBaseName = null)
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
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxDto $fax
     *
     * @return static
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxDto $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxDto
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFaxId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Fax\FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    /**
     * @return integer | null
     */
    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $dstCountry
     *
     * @return static
     */
    public function setDstCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $dstCountry = null)
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getDstCountry()
    {
        return $this->dstCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDstCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setDstCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getDstCountryId()
    {
        if ($dto = $this->getDstCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
