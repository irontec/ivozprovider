<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* MusicOnHoldDtoAbstract
* @codeCoverageIgnore
*/
abstract class MusicOnHoldDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $status = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var int|null
     */
    private $originalFileFileSize = null;

    /**
     * @var string|null
     */
    private $originalFileMimeType = null;

    /**
     * @var string|null
     */
    private $originalFileBaseName = null;

    /**
     * @var int|null
     */
    private $encodedFileFileSize = null;

    /**
     * @var string|null
     */
    private $encodedFileMimeType = null;

    /**
     * @var string|null
     */
    private $encodedFileBaseName = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

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
            'name' => 'name',
            'status' => 'status',
            'id' => 'id',
            'originalFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'encodedFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'brandId' => 'brand',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'originalFile' => [
                'fileSize' => $this->getOriginalFileFileSize(),
                'mimeType' => $this->getOriginalFileMimeType(),
                'baseName' => $this->getOriginalFileBaseName(),
            ],
            'encodedFile' => [
                'fileSize' => $this->getEncodedFileFileSize(),
                'mimeType' => $this->getEncodedFileMimeType(),
                'baseName' => $this->getEncodedFileBaseName(),
            ],
            'brand' => $this->getBrand(),
            'company' => $this->getCompany()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setOriginalFileFileSize(?int $originalFileFileSize): static
    {
        $this->originalFileFileSize = $originalFileFileSize;

        return $this;
    }

    public function getOriginalFileFileSize(): ?int
    {
        return $this->originalFileFileSize;
    }

    public function setOriginalFileMimeType(?string $originalFileMimeType): static
    {
        $this->originalFileMimeType = $originalFileMimeType;

        return $this;
    }

    public function getOriginalFileMimeType(): ?string
    {
        return $this->originalFileMimeType;
    }

    public function setOriginalFileBaseName(?string $originalFileBaseName): static
    {
        $this->originalFileBaseName = $originalFileBaseName;

        return $this;
    }

    public function getOriginalFileBaseName(): ?string
    {
        return $this->originalFileBaseName;
    }

    public function setEncodedFileFileSize(?int $encodedFileFileSize): static
    {
        $this->encodedFileFileSize = $encodedFileFileSize;

        return $this;
    }

    public function getEncodedFileFileSize(): ?int
    {
        return $this->encodedFileFileSize;
    }

    public function setEncodedFileMimeType(?string $encodedFileMimeType): static
    {
        $this->encodedFileMimeType = $encodedFileMimeType;

        return $this;
    }

    public function getEncodedFileMimeType(): ?string
    {
        return $this->encodedFileMimeType;
    }

    public function setEncodedFileBaseName(?string $encodedFileBaseName): static
    {
        $this->encodedFileBaseName = $encodedFileBaseName;

        return $this;
    }

    public function getEncodedFileBaseName(): ?string
    {
        return $this->encodedFileBaseName;
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
}
