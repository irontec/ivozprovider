<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Fax\FaxDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* FaxesInOutDtoAbstract
* @codeCoverageIgnore
*/
abstract class FaxesInOutDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $calldate = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     */
    private $src = null;

    /**
     * @var string|null
     */
    private $dst = null;

    /**
     * @var string|null
     */
    private $type = 'Out';

    /**
     * @var string|null
     */
    private $pages = null;

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
     * @var FaxDto | null
     */
    private $fax = null;

    /**
     * @var CountryDto | null
     */
    private $dstCountry = null;

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
            'calldate' => 'calldate',
            'src' => 'src',
            'dst' => 'dst',
            'type' => 'type',
            'pages' => 'pages',
            'status' => 'status',
            'id' => 'id',
            'file' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'faxId' => 'fax',
            'dstCountryId' => 'dstCountry'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
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
                'baseName' => $this->getFileBaseName(),
            ],
            'fax' => $this->getFax(),
            'dstCountry' => $this->getDstCountry()
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

    public function setCalldate(\DateTimeInterface|string $calldate): static
    {
        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTimeInterface|string|null
    {
        return $this->calldate;
    }

    public function setSrc(?string $src): static
    {
        $this->src = $src;

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setDst(?string $dst): static
    {
        $this->dst = $dst;

        return $this;
    }

    public function getDst(): ?string
    {
        return $this->dst;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setPages(?string $pages): static
    {
        $this->pages = $pages;

        return $this;
    }

    public function getPages(): ?string
    {
        return $this->pages;
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

    public function setFax(?FaxDto $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): ?FaxDto
    {
        return $this->fax;
    }

    public function setFaxId($id): static
    {
        $value = !is_null($id)
            ? new FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDstCountry(?CountryDto $dstCountry): static
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    public function getDstCountry(): ?CountryDto
    {
        return $this->dstCountry;
    }

    public function setDstCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setDstCountry($value);
    }

    public function getDstCountryId()
    {
        if ($dto = $this->getDstCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
