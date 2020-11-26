<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;

/**
* CallCsvReportDtoAbstract
* @codeCoverageIgnore
*/
abstract class CallCsvReportDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $sentTo = '';

    /**
     * @var \DateTimeInterface
     */
    private $inDate;

    /**
     * @var \DateTimeInterface
     */
    private $outDate;

    /**
     * @var \DateTimeInterface
     */
    private $createdOn;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $csvFileSize;

    /**
     * @var string | null
     */
    private $csvMimeType;

    /**
     * @var string | null
     */
    private $csvBaseName;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CallCsvSchedulerDto | null
     */
    private $callCsvScheduler;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'csv' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
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
        $response = [
            'sentTo' => $this->getSentTo(),
            'inDate' => $this->getInDate(),
            'outDate' => $this->getOutDate(),
            'createdOn' => $this->getCreatedOn(),
            'id' => $this->getId(),
            'csv' => [
                'fileSize' => $this->getCsvFileSize(),
                'mimeType' => $this->getCsvMimeType(),
                'baseName' => $this->getCsvBaseName(),
            ],
            'company' => $this->getCompany(),
            'brand' => $this->getBrand(),
            'callCsvScheduler' => $this->getCallCsvScheduler()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $sentTo | null
     *
     * @return static
     */
    public function setSentTo(?string $sentTo = null): self
    {
        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSentTo(): ?string
    {
        return $this->sentTo;
    }

    /**
     * @param \DateTimeInterface $inDate | null
     *
     * @return static
     */
    public function setInDate($inDate = null): self
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getInDate()
    {
        return $this->inDate;
    }

    /**
     * @param \DateTimeInterface $outDate | null
     *
     * @return static
     */
    public function setOutDate($outDate = null): self
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * @param \DateTimeInterface $createdOn | null
     *
     * @return static
     */
    public function setCreatedOn($createdOn = null): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $csvFileSize | null
     *
     * @return static
     */
    public function setCsvFileSize(?int $csvFileSize = null): self
    {
        $this->csvFileSize = $csvFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getCsvFileSize(): ?int
    {
        return $this->csvFileSize;
    }

    /**
     * @param string $csvMimeType | null
     *
     * @return static
     */
    public function setCsvMimeType(?string $csvMimeType = null): self
    {
        $this->csvMimeType = $csvMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCsvMimeType(): ?string
    {
        return $this->csvMimeType;
    }

    /**
     * @param string $csvBaseName | null
     *
     * @return static
     */
    public function setCsvBaseName(?string $csvBaseName = null): self
    {
        $this->csvBaseName = $csvBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCsvBaseName(): ?string
    {
        return $this->csvBaseName;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CallCsvSchedulerDto | null
     *
     * @return static
     */
    public function setCallCsvScheduler(?CallCsvSchedulerDto $callCsvScheduler = null): self
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    /**
     * @return CallCsvSchedulerDto | null
     */
    public function getCallCsvScheduler(): ?CallCsvSchedulerDto
    {
        return $this->callCsvScheduler;
    }

    /**
     * @return static
     */
    public function setCallCsvSchedulerId($id): self
    {
        $value = !is_null($id)
            ? new CallCsvSchedulerDto($id)
            : null;

        return $this->setCallCsvScheduler($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallCsvSchedulerId()
    {
        if ($dto = $this->getCallCsvScheduler()) {
            return $dto->getId();
        }

        return null;
    }

}
