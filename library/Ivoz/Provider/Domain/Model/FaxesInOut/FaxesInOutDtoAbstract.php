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
     * @var \DateTimeInterface
     */
    private $calldate;

    /**
     * @var string | null
     */
    private $src;

    /**
     * @var string | null
     */
    private $dst;

    /**
     * @var string | null
     */
    private $type = 'Out';

    /**
     * @var string | null
     */
    private $pages;

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
     * @var FaxDto | null
     */
    private $fax;

    /**
     * @var CountryDto | null
     */
    private $dstCountry;

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param \DateTimeInterface $calldate | null
     *
     * @return static
     */
    public function setCalldate($calldate = null): self
    {
        $this->calldate = $calldate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * @param string $src | null
     *
     * @return static
     */
    public function setSrc(?string $src = null): self
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSrc(): ?string
    {
        return $this->src;
    }

    /**
     * @param string $dst | null
     *
     * @return static
     */
    public function setDst(?string $dst = null): self
    {
        $this->dst = $dst;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDst(): ?string
    {
        return $this->dst;
    }

    /**
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $pages | null
     *
     * @return static
     */
    public function setPages(?string $pages = null): self
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPages(): ?string
    {
        return $this->pages;
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
     * @param FaxDto | null
     *
     * @return static
     */
    public function setFax(?FaxDto $fax = null): self
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return FaxDto | null
     */
    public function getFax(): ?FaxDto
    {
        return $this->fax;
    }

    /**
     * @return static
     */
    public function setFaxId($id): self
    {
        $value = !is_null($id)
            ? new FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    /**
     * @return mixed | null
     */
    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setDstCountry(?CountryDto $dstCountry = null): self
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getDstCountry(): ?CountryDto
    {
        return $this->dstCountry;
    }

    /**
     * @return static
     */
    public function setDstCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setDstCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getDstCountryId()
    {
        if ($dto = $this->getDstCountry()) {
            return $dto->getId();
        }

        return null;
    }

}
