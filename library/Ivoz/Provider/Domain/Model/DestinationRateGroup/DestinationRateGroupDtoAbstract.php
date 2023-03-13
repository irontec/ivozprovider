<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;

/**
* DestinationRateGroupDtoAbstract
* @codeCoverageIgnore
*/
abstract class DestinationRateGroupDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $status = null;

    /**
     * @var string|null
     */
    private $lastExecutionError = null;

    /**
     * @var bool|null
     */
    private $deductibleConnectionFee = false;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string|null
     */
    private $nameEn = null;

    /**
     * @var string|null
     */
    private $nameEs = null;

    /**
     * @var string|null
     */
    private $nameCa = null;

    /**
     * @var string|null
     */
    private $nameIt = null;

    /**
     * @var string|null
     */
    private $descriptionEn = null;

    /**
     * @var string|null
     */
    private $descriptionEs = null;

    /**
     * @var string|null
     */
    private $descriptionCa = null;

    /**
     * @var string|null
     */
    private $descriptionIt = null;

    /**
     * @var int|null
     */
    private $fileFileSize = null;

    /**
     * @var string|null
     */
    private $fileMimeType = null;

    /**
     * @var string|null
     */
    private $fileBaseName = null;

    /**
     * @var array|null
     */
    private $fileImporterArguments = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CurrencyDto | null
     */
    private $currency = null;

    /**
     * @var DestinationRateDto[] | null
     */
    private $destinationRates = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'status' => 'status',
            'lastExecutionError' => 'lastExecutionError',
            'deductibleConnectionFee' => 'deductibleConnectionFee',
            'id' => 'id',
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'description' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'file' => [
                'fileSize',
                'mimeType',
                'baseName',
                'importerArguments',
            ],
            'brandId' => 'brand',
            'currencyId' => 'currency'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'status' => $this->getStatus(),
            'lastExecutionError' => $this->getLastExecutionError(),
            'deductibleConnectionFee' => $this->getDeductibleConnectionFee(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt(),
            ],
            'file' => [
                'fileSize' => $this->getFileFileSize(),
                'mimeType' => $this->getFileMimeType(),
                'baseName' => $this->getFileBaseName(),
                'importerArguments' => $this->getFileImporterArguments(),
            ],
            'brand' => $this->getBrand(),
            'currency' => $this->getCurrency(),
            'destinationRates' => $this->getDestinationRates()
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

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setLastExecutionError(?string $lastExecutionError): static
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    public function setDeductibleConnectionFee(bool $deductibleConnectionFee): static
    {
        $this->deductibleConnectionFee = $deductibleConnectionFee;

        return $this;
    }

    public function getDeductibleConnectionFee(): ?bool
    {
        return $this->deductibleConnectionFee;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setNameEn(string $nameEn): static
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEs(string $nameEs): static
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameCa(string $nameCa): static
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    public function setNameIt(string $nameIt): static
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

    public function setDescriptionEn(string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEs(string $descriptionEs): static
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    public function setDescriptionCa(string $descriptionCa): static
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    public function setDescriptionIt(string $descriptionIt): static
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
    }

    public function setFileFileSize(?int $fileFileSize): static
    {
        $this->fileFileSize = $fileFileSize;

        return $this;
    }

    public function getFileFileSize(): ?int
    {
        return $this->fileFileSize;
    }

    public function setFileMimeType(?string $fileMimeType): static
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    public function getFileMimeType(): ?string
    {
        return $this->fileMimeType;
    }

    public function setFileBaseName(?string $fileBaseName): static
    {
        $this->fileBaseName = $fileBaseName;

        return $this;
    }

    public function getFileBaseName(): ?string
    {
        return $this->fileBaseName;
    }

    public function setFileImporterArguments(?array $fileImporterArguments): static
    {
        $this->fileImporterArguments = $fileImporterArguments;

        return $this;
    }

    public function getFileImporterArguments(): ?array
    {
        return $this->fileImporterArguments;
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

    public function setCurrency(?CurrencyDto $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    public function setCurrencyId($id): static
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDestinationRates(?array $destinationRates): static
    {
        $this->destinationRates = $destinationRates;

        return $this;
    }

    /**
    * @return DestinationRateDto[] | null
    */
    public function getDestinationRates(): ?array
    {
        return $this->destinationRates;
    }
}
