<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;

/**
* WebPortalDtoAbstract
* @codeCoverageIgnore
*/
abstract class WebPortalDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $url = null;

    /**
     * @var string|null
     */
    private $klearTheme = '';

    /**
     * @var string|null
     */
    private $urlType = null;

    /**
     * @var bool|null
     */
    private $newUI = true;

    /**
     * @var string|null
     */
    private $name = '';

    /**
     * @var string|null
     */
    private $color = '#000000';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var int|null
     */
    private $logoFileSize = null;

    /**
     * @var string|null
     */
    private $logoMimeType = null;

    /**
     * @var string|null
     */
    private $logoBaseName = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    public function __construct(?int $id = null)
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
            'url' => 'url',
            'klearTheme' => 'klearTheme',
            'urlType' => 'urlType',
            'newUI' => 'newUI',
            'name' => 'name',
            'color' => 'color',
            'id' => 'id',
            'logo' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'url' => $this->getUrl(),
            'klearTheme' => $this->getKlearTheme(),
            'urlType' => $this->getUrlType(),
            'newUI' => $this->getNewUI(),
            'name' => $this->getName(),
            'color' => $this->getColor(),
            'id' => $this->getId(),
            'logo' => [
                'fileSize' => $this->getLogoFileSize(),
                'mimeType' => $this->getLogoMimeType(),
                'baseName' => $this->getLogoBaseName(),
            ],
            'brand' => $this->getBrand()
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

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setKlearTheme(?string $klearTheme): static
    {
        $this->klearTheme = $klearTheme;

        return $this;
    }

    public function getKlearTheme(): ?string
    {
        return $this->klearTheme;
    }

    public function setUrlType(string $urlType): static
    {
        $this->urlType = $urlType;

        return $this;
    }

    public function getUrlType(): ?string
    {
        return $this->urlType;
    }

    public function setNewUI(bool $newUI): static
    {
        $this->newUI = $newUI;

        return $this;
    }

    public function getNewUI(): ?bool
    {
        return $this->newUI;
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

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLogoFileSize(?int $logoFileSize): static
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    public function getLogoFileSize(): ?int
    {
        return $this->logoFileSize;
    }

    public function setLogoMimeType(?string $logoMimeType): static
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    public function getLogoMimeType(): ?string
    {
        return $this->logoMimeType;
    }

    public function setLogoBaseName(?string $logoBaseName): static
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    public function getLogoBaseName(): ?string
    {
        return $this->logoBaseName;
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

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }
}
