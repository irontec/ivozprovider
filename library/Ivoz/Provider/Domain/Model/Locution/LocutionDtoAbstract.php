<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* LocutionDtoAbstract
* @codeCoverageIgnore
*/
abstract class LocutionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int|null
     */
    private $encodedFileFileSize;

    /**
     * @var string|null
     */
    private $encodedFileMimeType;

    /**
     * @var string|null
     */
    private $encodedFileBaseName;

    /**
     * @var int|null
     */
    private $originalFileFileSize;

    /**
     * @var string|null
     */
    private $originalFileMimeType;

    /**
     * @var string|null
     */
    private $originalFileBaseName;

    /**
     * @var CompanyDto | null
     */
    private $company;

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
            'name' => 'name',
            'status' => 'status',
            'id' => 'id',
            'encodedFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'originalFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'companyId' => 'company'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'encodedFile' => [
                'fileSize' => $this->getEncodedFileFileSize(),
                'mimeType' => $this->getEncodedFileMimeType(),
                'baseName' => $this->getEncodedFileBaseName(),
            ],
            'originalFile' => [
                'fileSize' => $this->getOriginalFileFileSize(),
                'mimeType' => $this->getOriginalFileMimeType(),
                'baseName' => $this->getOriginalFileBaseName(),
            ],
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

    public function setName(?string $name): static
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

    public function getId()
    {
        return $this->id;
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
