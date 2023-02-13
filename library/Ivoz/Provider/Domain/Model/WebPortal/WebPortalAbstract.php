<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\WebPortal\Logo;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* WebPortalAbstract
* @codeCoverageIgnore
*/
abstract class WebPortalAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var ?string
     */
    protected $klearTheme = '';

    /**
     * @var string
     * comment: enum:god|brand|admin|user
     */
    protected $urlType;

    /**
     * @var ?string
     */
    protected $name = '';

    /**
     * @var ?string
     */
    protected $userTheme = '';

    /**
     * @var Logo
     */
    protected $logo;

    /**
     * @var ?BrandInterface
     * inversedBy urls
     */
    protected $brand = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $url,
        string $urlType,
        Logo $logo
    ) {
        $this->setUrl($url);
        $this->setUrlType($urlType);
        $this->logo = $logo;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "WebPortal",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): WebPortalDto
    {
        return new WebPortalDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|WebPortalInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?WebPortalDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, WebPortalInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param WebPortalDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, WebPortalDto::class);
        $url = $dto->getUrl();
        Assertion::notNull($url, 'getUrl value is null, but non null value was expected.');
        $urlType = $dto->getUrlType();
        Assertion::notNull($urlType, 'getUrlType value is null, but non null value was expected.');

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $self = new static(
            $url,
            $urlType,
            $logo
        );

        $self
            ->setKlearTheme($dto->getKlearTheme())
            ->setName($dto->getName())
            ->setUserTheme($dto->getUserTheme())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param WebPortalDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, WebPortalDto::class);

        $url = $dto->getUrl();
        Assertion::notNull($url, 'getUrl value is null, but non null value was expected.');
        $urlType = $dto->getUrlType();
        Assertion::notNull($urlType, 'getUrlType value is null, but non null value was expected.');

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $this
            ->setUrl($url)
            ->setKlearTheme($dto->getKlearTheme())
            ->setUrlType($urlType)
            ->setName($dto->getName())
            ->setUserTheme($dto->getUserTheme())
            ->setLogo($logo)
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): WebPortalDto
    {
        return self::createDto()
            ->setUrl(self::getUrl())
            ->setKlearTheme(self::getKlearTheme())
            ->setUrlType(self::getUrlType())
            ->setName(self::getName())
            ->setUserTheme(self::getUserTheme())
            ->setLogoFileSize(self::getLogo()->getFileSize())
            ->setLogoMimeType(self::getLogo()->getMimeType())
            ->setLogoBaseName(self::getLogo()->getBaseName())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'url' => self::getUrl(),
            'klearTheme' => self::getKlearTheme(),
            'urlType' => self::getUrlType(),
            'name' => self::getName(),
            'userTheme' => self::getUserTheme(),
            'logoFileSize' => self::getLogo()->getFileSize(),
            'logoMimeType' => self::getLogo()->getMimeType(),
            'logoBaseName' => self::getLogo()->getBaseName(),
            'brandId' => self::getBrand()?->getId()
        ];
    }

    protected function setUrl(string $url): static
    {
        Assertion::maxLength($url, 255, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    protected function setKlearTheme(?string $klearTheme = null): static
    {
        if (!is_null($klearTheme)) {
            Assertion::maxLength($klearTheme, 200, 'klearTheme value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->klearTheme = $klearTheme;

        return $this;
    }

    public function getKlearTheme(): ?string
    {
        return $this->klearTheme;
    }

    protected function setUrlType(string $urlType): static
    {
        Assertion::maxLength($urlType, 25, 'urlType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $urlType,
            [
                WebPortalInterface::URLTYPE_GOD,
                WebPortalInterface::URLTYPE_BRAND,
                WebPortalInterface::URLTYPE_ADMIN,
                WebPortalInterface::URLTYPE_USER,
            ],
            'urlTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->urlType = $urlType;

        return $this;
    }

    public function getUrlType(): string
    {
        return $this->urlType;
    }

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 200, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setUserTheme(?string $userTheme = null): static
    {
        if (!is_null($userTheme)) {
            Assertion::maxLength($userTheme, 200, 'userTheme value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->userTheme = $userTheme;

        return $this;
    }

    public function getUserTheme(): ?string
    {
        return $this->userTheme;
    }

    public function getLogo(): Logo
    {
        return $this->logo;
    }

    protected function setLogo(Logo $logo): static
    {
        $isEqual = $this->logo->equals($logo);
        if ($isEqual) {
            return $this;
        }

        $this->logo = $logo;
        return $this;
    }

    public function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }
}
