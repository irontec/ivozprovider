<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BrandUrlAbstract
 * @codeCoverageIgnore
 */
abstract class BrandUrlAbstract
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $klearTheme = '';

    /**
     * comment: enum:god|brand|admin|user
     * @var string
     */
    protected $urlType;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $userTheme = '';

    /**
     * @var Logo
     */
    protected $logo;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
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
            "BrandUrl",
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
     * @return BrandUrlDto
     */
    public static function createDto($id = null)
    {
        return new BrandUrlDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return BrandUrlDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BrandUrlInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandUrlDto
         */
        Assertion::isInstanceOf($dto, BrandUrlDto::class);

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
            ->setBrand($dto->getBrand())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandUrlDto
         */
        Assertion::isInstanceOf($dto, BrandUrlDto::class);

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
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return BrandUrlDto
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
     * @deprecated
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
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
     * @deprecated
     * Set klearTheme
     *
     * @param string $klearTheme
     *
     * @return self
     */
    public function setKlearTheme($klearTheme = null)
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
     * @return string
     */
    public function getKlearTheme()
    {
        return $this->klearTheme;
    }

    /**
     * @deprecated
     * Set urlType
     *
     * @param string $urlType
     *
     * @return self
     */
    public function setUrlType($urlType)
    {
        Assertion::notNull($urlType, 'urlType value "%s" is null, but non null value was expected.');
        Assertion::maxLength($urlType, 25, 'urlType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($urlType, array (
          0 => 'god',
          1 => 'brand',
          2 => 'admin',
          3 => 'user',
        ), 'urlTypevalue "%s" is not an element of the valid values: %s');

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
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @deprecated
     * Set userTheme
     *
     * @param string $userTheme
     *
     * @return self
     */
    public function setUserTheme($userTheme = null)
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
     * @return string
     */
    public function getUserTheme()
    {
        return $this->userTheme;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set logo
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\Logo $logo
     *
     * @return self
     */
    public function setLogo(Logo $logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\BrandUrl\Logo
     */
    public function getLogo()
    {
        return $this->logo;
    }
    // @codeCoverageIgnoreEnd
}
