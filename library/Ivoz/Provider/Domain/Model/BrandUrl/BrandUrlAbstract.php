<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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
     * @comment enum:god|brand|admin|user
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


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

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
        return sprintf("%s#%s",
            "BrandUrl",
            $this->getId()
        );
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return BrandUrlDTO
     */
    public static function createDTO()
    {
        return new BrandUrlDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandUrlDTO
         */
        Assertion::isInstanceOf($dto, BrandUrlDTO::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandUrlDTO
         */
        Assertion::isInstanceOf($dto, BrandUrlDTO::class);

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
     * @return BrandUrlDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setUrl($this->getUrl())
            ->setKlearTheme($this->getKlearTheme())
            ->setUrlType($this->getUrlType())
            ->setName($this->getName())
            ->setUserTheme($this->getUserTheme())
            ->setLogoFileSize($this->getLogo()->getFileSize())
            ->setLogoMimeType($this->getLogo()->getMimeType())
            ->setLogoBaseName($this->getLogo()->getBaseName())
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null);
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

