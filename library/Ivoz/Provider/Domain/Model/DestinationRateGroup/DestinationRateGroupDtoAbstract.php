<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
     * @var string | null
     */
    private $status;

    /**
     * @var string | null
     */
    private $lastExecutionError;

    /**
     * @var bool
     */
    private $deductibleConnectionFee = false;

    /**
     * @var int
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
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;

    /**
     * @var string
     */
    private $descriptionEn;

    /**
     * @var string
     */
    private $descriptionEs;

    /**
     * @var string
     */
    private $descriptionCa;

    /**
     * @var string
     */
    private $descriptionIt;

    /**
     * @var int | null
     */
    private $fileFileSize;

    /**
     * @var string | null
     */
    private $fileMimeType;

    /**
     * @var string | null
     */
    private $fileBaseName;

    /**
     * @var array | null
     */
    private $fileImporterArguments;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CurrencyDto | null
     */
    private $currency;

    /**
     * @var DestinationRateDto[] | null
     */
    private $destinationRates;

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $status | null
     *
     * @return static
     */
    public function setStatus(?string $status = null): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    public function setLastExecutionError(?string $lastExecutionError = null): self
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    /**
     * @param bool $deductibleConnectionFee | null
     *
     * @return static
     */
    public function setDeductibleConnectionFee(?bool $deductibleConnectionFee = null): self
    {
        $this->deductibleConnectionFee = $deductibleConnectionFee;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getDeductibleConnectionFee(): ?bool
    {
        return $this->deductibleConnectionFee;
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
     * @param string $nameEn | null
     *
     * @return static
     */
    public function setNameEn(?string $nameEn = null): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs | null
     *
     * @return static
     */
    public function setNameEs(?string $nameEs = null): self
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa | null
     *
     * @return static
     */
    public function setNameCa(?string $nameCa = null): self
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt | null
     *
     * @return static
     */
    public function setNameIt(?string $nameIt = null): self
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

    /**
     * @param string $descriptionEn | null
     *
     * @return static
     */
    public function setDescriptionEn(?string $descriptionEn = null): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs | null
     *
     * @return static
     */
    public function setDescriptionEs(?string $descriptionEs = null): self
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa | null
     *
     * @return static
     */
    public function setDescriptionCa(?string $descriptionCa = null): self
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt | null
     *
     * @return static
     */
    public function setDescriptionIt(?string $descriptionIt = null): self
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
    }

    /**
     * @param int $fileFileSize | null
     *
     * @return static
     */
    public function setFileFileSize(?int $fileFileSize = null): self
    {
        $this->fileFileSize = $fileFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFileFileSize(): ?int
    {
        return $this->fileFileSize;
    }

    /**
     * @param string $fileMimeType | null
     *
     * @return static
     */
    public function setFileMimeType(?string $fileMimeType = null): self
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFileMimeType(): ?string
    {
        return $this->fileMimeType;
    }

    /**
     * @param string $fileBaseName | null
     *
     * @return static
     */
    public function setFileBaseName(?string $fileBaseName = null): self
    {
        $this->fileBaseName = $fileBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFileBaseName(): ?string
    {
        return $this->fileBaseName;
    }

    /**
     * @param array $fileImporterArguments | null
     *
     * @return static
     */
    public function setFileImporterArguments(?array $fileImporterArguments = null): self
    {
        $this->fileImporterArguments = $fileImporterArguments;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getFileImporterArguments(): ?array
    {
        return $this->fileImporterArguments;
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
     * @param CurrencyDto | null
     *
     * @return static
     */
    public function setCurrency(?CurrencyDto $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return CurrencyDto | null
     */
    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    /**
     * @return static
     */
    public function setCurrencyId($id): self
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    /**
     * @return mixed | null
     */
    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DestinationRateDto[] | null
     *
     * @return static
     */
    public function setDestinationRates(?array $destinationRates = null): self
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
