<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;

/**
* WebPortalDtoAbstract
* @codeCoverageIgnore
*/
abstract class WebPortalDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string | null
     */
    private $klearTheme = '';

    /**
     * @var string
     */
    private $urlType;

    /**
     * @var string | null
     */
    private $name = '';

    /**
     * @var string | null
     */
    private $userTheme = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $logoFileSize;

    /**
     * @var string | null
     */
    private $logoMimeType;

    /**
     * @var string | null
     */
    private $logoBaseName;

    /**
     * @var BrandDto | null
     */
    private $brand;

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
            'url' => 'url',
            'klearTheme' => 'klearTheme',
            'urlType' => 'urlType',
            'name' => 'name',
            'userTheme' => 'userTheme',
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'url' => $this->getUrl(),
            'klearTheme' => $this->getKlearTheme(),
            'urlType' => $this->getUrlType(),
            'name' => $this->getName(),
            'userTheme' => $this->getUserTheme(),
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

    /**
     * @param string $url | null
     *
     * @return static
     */
    public function setUrl(?string $url = null): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $klearTheme | null
     *
     * @return static
     */
    public function setKlearTheme(?string $klearTheme = null): self
    {
        $this->klearTheme = $klearTheme;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getKlearTheme(): ?string
    {
        return $this->klearTheme;
    }

    /**
     * @param string $urlType | null
     *
     * @return static
     */
    public function setUrlType(?string $urlType = null): self
    {
        $this->urlType = $urlType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUrlType(): ?string
    {
        return $this->urlType;
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
     * @param string $userTheme | null
     *
     * @return static
     */
    public function setUserTheme(?string $userTheme = null): self
    {
        $this->userTheme = $userTheme;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUserTheme(): ?string
    {
        return $this->userTheme;
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
     * @param int $logoFileSize | null
     *
     * @return static
     */
    public function setLogoFileSize(?int $logoFileSize = null): self
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLogoFileSize(): ?int
    {
        return $this->logoFileSize;
    }

    /**
     * @param string $logoMimeType | null
     *
     * @return static
     */
    public function setLogoMimeType(?string $logoMimeType = null): self
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoMimeType(): ?string
    {
        return $this->logoMimeType;
    }

    /**
     * @param string $logoBaseName | null
     *
     * @return static
     */
    public function setLogoBaseName(?string $logoBaseName = null): self
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogoBaseName(): ?string
    {
        return $this->logoBaseName;
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

}
