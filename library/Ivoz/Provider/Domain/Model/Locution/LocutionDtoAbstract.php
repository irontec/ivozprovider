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
     * @var string | null
     */
    private $status;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $encodedFileFileSize;

    /**
     * @var string | null
     */
    private $encodedFileMimeType;

    /**
     * @var string | null
     */
    private $encodedFileBaseName;

    /**
     * @var int | null
     */
    private $originalFileFileSize;

    /**
     * @var string | null
     */
    private $originalFileMimeType;

    /**
     * @var string | null
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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @param int $encodedFileFileSize | null
     *
     * @return static
     */
    public function setEncodedFileFileSize(?int $encodedFileFileSize = null): self
    {
        $this->encodedFileFileSize = $encodedFileFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getEncodedFileFileSize(): ?int
    {
        return $this->encodedFileFileSize;
    }

    /**
     * @param string $encodedFileMimeType | null
     *
     * @return static
     */
    public function setEncodedFileMimeType(?string $encodedFileMimeType = null): self
    {
        $this->encodedFileMimeType = $encodedFileMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEncodedFileMimeType(): ?string
    {
        return $this->encodedFileMimeType;
    }

    /**
     * @param string $encodedFileBaseName | null
     *
     * @return static
     */
    public function setEncodedFileBaseName(?string $encodedFileBaseName = null): self
    {
        $this->encodedFileBaseName = $encodedFileBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEncodedFileBaseName(): ?string
    {
        return $this->encodedFileBaseName;
    }

    /**
     * @param int $originalFileFileSize | null
     *
     * @return static
     */
    public function setOriginalFileFileSize(?int $originalFileFileSize = null): self
    {
        $this->originalFileFileSize = $originalFileFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getOriginalFileFileSize(): ?int
    {
        return $this->originalFileFileSize;
    }

    /**
     * @param string $originalFileMimeType | null
     *
     * @return static
     */
    public function setOriginalFileMimeType(?string $originalFileMimeType = null): self
    {
        $this->originalFileMimeType = $originalFileMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOriginalFileMimeType(): ?string
    {
        return $this->originalFileMimeType;
    }

    /**
     * @param string $originalFileBaseName | null
     *
     * @return static
     */
    public function setOriginalFileBaseName(?string $originalFileBaseName = null): self
    {
        $this->originalFileBaseName = $originalFileBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOriginalFileBaseName(): ?string
    {
        return $this->originalFileBaseName;
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

}
