<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CallCsvReportDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $sentTo = '';

    /**
     * @var \DateTime
     */
    private $inDate;

    /**
     * @var \DateTime
     */
    private $outDate;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $csvFileSize;

    /**
     * @var string
     */
    private $csvMimeType;

    /**
     * @var string
     */
    private $csvBaseName;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto | null
     */
    private $callCsvScheduler;


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
            'sentTo' => 'sentTo',
            'inDate' => 'inDate',
            'outDate' => 'outDate',
            'createdOn' => 'createdOn',
            'id' => 'id',
            'csv' => ['fileSize','mimeType','baseName'],
            'companyId' => 'company',
            'brandId' => 'brand',
            'callCsvSchedulerId' => 'callCsvScheduler'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'sentTo' => $this->getSentTo(),
            'inDate' => $this->getInDate(),
            'outDate' => $this->getOutDate(),
            'createdOn' => $this->getCreatedOn(),
            'id' => $this->getId(),
            'csv' => [
                'fileSize' => $this->getCsvFileSize(),
                'mimeType' => $this->getCsvMimeType(),
                'baseName' => $this->getCsvBaseName()
            ],
            'company' => $this->getCompany(),
            'brand' => $this->getBrand(),
            'callCsvScheduler' => $this->getCallCsvScheduler()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->callCsvScheduler = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\CallCsvScheduler\\CallCsvScheduler', $this->getCallCsvSchedulerId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
    }

    /**
     * @param string $sentTo
     *
     * @return static
     */
    public function setSentTo($sentTo = null)
    {
        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getSentTo()
    {
        return $this->sentTo;
    }

    /**
     * @param \DateTime $inDate
     *
     * @return static
     */
    public function setInDate($inDate = null)
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInDate()
    {
        return $this->inDate;
    }

    /**
     * @param \DateTime $outDate
     *
     * @return static
     */
    public function setOutDate($outDate = null)
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * @param \DateTime $createdOn
     *
     * @return static
     */
    public function setCreatedOn($createdOn = null)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * @param integer $csvFileSize
     *
     * @return static
     */
    public function setCsvFileSize($csvFileSize = null)
    {
        $this->csvFileSize = $csvFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCsvFileSize()
    {
        return $this->csvFileSize;
    }

    /**
     * @param string $csvMimeType
     *
     * @return static
     */
    public function setCsvMimeType($csvMimeType = null)
    {
        $this->csvMimeType = $csvMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getCsvMimeType()
    {
        return $this->csvMimeType;
    }

    /**
     * @param string $csvBaseName
     *
     * @return static
     */
    public function setCsvBaseName($csvBaseName = null)
    {
        $this->csvBaseName = $csvBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCsvBaseName()
    {
        return $this->csvBaseName;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
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
     * @param \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto $callCsvScheduler
     *
     * @return static
     */
    public function setCallCsvScheduler(\Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto $callCsvScheduler = null)
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto
     */
    public function getCallCsvScheduler()
    {
        return $this->callCsvScheduler;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCallCsvSchedulerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto($id)
            : null;

        return $this->setCallCsvScheduler($value);
    }

    /**
     * @return integer | null
     */
    public function getCallCsvSchedulerId()
    {
        if ($dto = $this->getCallCsvScheduler()) {
            return $dto->getId();
        }

        return null;
    }
}
