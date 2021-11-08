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
     * @var \DateTimeInterface|string
     */
    private $inDate;

    /**
     * @var \DateTimeInterface|string
     */
    private $outDate;

    /**
     * @var \DateTimeInterface|string
     */
    private $createdOn;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int|null
     */
    private $csvFileSize;

    /**
     * @var string|null
     */
    private $csvMimeType;

    /**
     * @var string|null
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

    public function setSentTo(string $sentTo): static
    {
        $this->sentTo = $sentTo;

        return $this;
    }

    public function getSentTo(): ?string
    {
        return $this->sentTo;
    }

    public function setInDate(\DateTimeInterface|string $inDate): static
    {
        $this->inDate = $inDate;

        return $this;
    }

    public function getInDate(): \DateTimeInterface|string|null
    {
        return $this->inDate;
    }

    public function setOutDate(\DateTimeInterface|string $outDate): static
    {
        $this->outDate = $outDate;

        return $this;
    }

    public function getOutDate(): \DateTimeInterface|string|null
    {
        return $this->outDate;
    }

    public function setCreatedOn(\DateTimeInterface|string $createdOn): static
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getCreatedOn(): \DateTimeInterface|string|null
    {
        return $this->createdOn;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCsvFileSize(?int $csvFileSize): static
    {
        $this->csvFileSize = $csvFileSize;

        return $this;
    }

    public function getCsvFileSize(): ?int
    {
        return $this->csvFileSize;
    }

    public function setCsvMimeType(?string $csvMimeType): static
    {
        $this->csvMimeType = $csvMimeType;

        return $this;
    }

    public function getCsvMimeType(): ?string
    {
        return $this->csvMimeType;
    }

    public function setCsvBaseName(?string $csvBaseName): static
    {
        $this->csvBaseName = $csvBaseName;

        return $this;
    }

    public function getCsvBaseName(): ?string
    {
        return $this->csvBaseName;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCallCsvScheduler(?CallCsvSchedulerDto $callCsvScheduler): static
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    public function getCallCsvScheduler(): ?CallCsvSchedulerDto
    {
        return $this->callCsvScheduler;
    }

    public function setCallCsvSchedulerId($id): static
    {
        $value = !is_null($id)
            ? new CallCsvSchedulerDto($id)
            : null;

        return $this->setCallCsvScheduler($value);
    }

    public function getCallCsvSchedulerId()
    {
        if ($dto = $this->getCallCsvScheduler()) {
            return $dto->getId();
        }

        return null;
    }
}
