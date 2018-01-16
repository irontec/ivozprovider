<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * InvoiceTemplateAbstract
 * @codeCoverageIgnore
 */
abstract class InvoiceTemplateAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $templateHeader;

    /**
     * @var string
     */
    protected $templateFooter;

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
    protected function __construct($name, $template)
    {
        $this->setName($name);
        $this->setTemplate($template);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "InvoiceTemplate",
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
     * @return InvoiceTemplateDTO
     */
    public static function createDTO()
    {
        return new InvoiceTemplateDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto InvoiceTemplateDTO
         */
        Assertion::isInstanceOf($dto, InvoiceTemplateDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getTemplate());

        $self
            ->setDescription($dto->getDescription())
            ->setTemplateHeader($dto->getTemplateHeader())
            ->setTemplateFooter($dto->getTemplateFooter())
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
         * @var $dto InvoiceTemplateDTO
         */
        Assertion::isInstanceOf($dto, InvoiceTemplateDTO::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTemplate($dto->getTemplate())
            ->setTemplateHeader($dto->getTemplateHeader())
            ->setTemplateFooter($dto->getTemplateFooter())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return InvoiceTemplateDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setDescription($this->getDescription())
            ->setTemplate($this->getTemplate())
            ->setTemplateHeader($this->getTemplateHeader())
            ->setTemplateFooter($this->getTemplateFooter())
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'template' => self::getTemplate(),
            'templateHeader' => self::getTemplateHeader(),
            'templateFooter' => self::getTemplateFooter(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 55, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 300, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set template
     *
     * @param string $template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        Assertion::notNull($template, 'template value "%s" is null, but non null value was expected.');
        Assertion::maxLength($template, 65535, 'template value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set templateHeader
     *
     * @param string $templateHeader
     *
     * @return self
     */
    public function setTemplateHeader($templateHeader = null)
    {
        if (!is_null($templateHeader)) {
            Assertion::maxLength($templateHeader, 65535, 'templateHeader value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->templateHeader = $templateHeader;

        return $this;
    }

    /**
     * Get templateHeader
     *
     * @return string
     */
    public function getTemplateHeader()
    {
        return $this->templateHeader;
    }

    /**
     * Set templateFooter
     *
     * @param string $templateFooter
     *
     * @return self
     */
    public function setTemplateFooter($templateFooter = null)
    {
        if (!is_null($templateFooter)) {
            Assertion::maxLength($templateFooter, 65535, 'templateFooter value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->templateFooter = $templateFooter;

        return $this;
    }

    /**
     * Get templateFooter
     *
     * @return string
     */
    public function getTemplateFooter()
    {
        return $this->templateFooter;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
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



    // @codeCoverageIgnoreEnd
}

