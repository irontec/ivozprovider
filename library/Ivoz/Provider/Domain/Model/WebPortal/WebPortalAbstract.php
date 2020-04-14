<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * WebPortalAbstract
 * @codeCoverageIgnore
 */
abstract class WebPortalAbstract
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string | null
     */
    protected $klearTheme = '';

    /**
     * comment: enum:god|brand|admin|user
     * @var string
     */
    protected $urlType;

    /**
     * @var string | null
     */
    protected $name = '';

    /**
     * @var string | null
     */
    protected $userTheme = '';

    /**
     * @var Logo | null
     */
    protected $logo;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($url, $urlType, Logo $logo)
    {
        $this->setUrl($url);
        $this->setUrlType($urlType);
        $this->setLogo($logo);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "WebPortal",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return WebPortalDto
     */
    public static function createDto($id = null)
    {
        return new WebPortalDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param WebPortalInterface|null $entity
     * @param int $depth
     * @return WebPortalDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var WebPortalDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param WebPortalDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, WebPortalDto::class);

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $self = new static(
            $dto->getUrl(),
            $dto->getUrlType(),
            $logo
        );

        $self
            ->setKlearTheme($dto->getKlearTheme())
            ->setName($dto->getName())
            ->setUserTheme($dto->getUserTheme())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param WebPortalDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, WebPortalDto::class);

        $logo = new Logo(
            $dto->getLogoFileSize(),
            $dto->getLogoMimeType(),
            $dto->getLogoBaseName()
        );

        $this
            ->setUrl($dto->getUrl())
            ->setKlearTheme($dto->getKlearTheme())
            ->setUrlType($dto->getUrlType())
            ->setName($dto->getName())
            ->setUserTheme($dto->getUserTheme())
            ->setLogo($logo)
            ->setBrand($fkTransformer->transform($dto->getBrand()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return WebPortalDto
     */
    public function toDto($depth = 0)
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
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set url
     *
     * @param string $url
     *
     * @return static
     */
    protected function setUrl($url)
    {
        Assertion::notNull($url, 'url value "%s" is null, but non null value was expected.');
        Assertion::maxLength($url, 255, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set klearTheme
     *
     * @param string $klearTheme | null
     *
     * @return static
     */
    protected function setKlearTheme($klearTheme = null)
    {
        if (!is_null($klearTheme)) {
            Assertion::maxLength($klearTheme, 200, 'klearTheme value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->klearTheme = $klearTheme;

        return $this;
    }

    /**
     * Get klearTheme
     *
     * @return string | null
     */
    public function getKlearTheme()
    {
        return $this->klearTheme;
    }

    /**
     * Set urlType
     *
     * @param string $urlType
     *
     * @return static
     */
    protected function setUrlType($urlType)
    {
        Assertion::notNull($urlType, 'urlType value "%s" is null, but non null value was expected.');
        Assertion::maxLength($urlType, 25, 'urlType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($urlType, [
            WebPortalInterface::URLTYPE_GOD,
            WebPortalInterface::URLTYPE_BRAND,
            WebPortalInterface::URLTYPE_ADMIN,
            WebPortalInterface::URLTYPE_USER
        ], 'urlTypevalue "%s" is not an element of the valid values: %s');

        $this->urlType = $urlType;

        return $this;
    }

    /**
     * Get urlType
     *
     * @return string
     */
    public function getUrlType()
    {
        return $this->urlType;
    }

    /**
     * Set name
     *
     * @param string $name | null
     *
     * @return static
     */
    protected function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 200, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set userTheme
     *
     * @param string $userTheme | null
     *
     * @return static
     */
    protected function setUserTheme($userTheme = null)
    {
        if (!is_null($userTheme)) {
            Assertion::maxLength($userTheme, 200, 'userTheme value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->userTheme = $userTheme;

        return $this;
    }

    /**
     * Get userTheme
     *
     * @return string | null
     */
    public function getUserTheme()
    {
        return $this->userTheme;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set logo
     *
     * @param \Ivoz\Provider\Domain\Model\WebPortal\Logo $logo
     *
     * @return static
     */
    protected function setLogo(Logo $logo)
    {
        $isEqual = $this->logo && $this->logo->equals($logo);
        if ($isEqual) {
            return $this;
        }

        $this->logo = $logo;
        return $this;
    }

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\WebPortal\Logo
     */
    public function getLogo()
    {
        return $this->logo;
    }
    // @codeCoverageIgnoreEnd
}
