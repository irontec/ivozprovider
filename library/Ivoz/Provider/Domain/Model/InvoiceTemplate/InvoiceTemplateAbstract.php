<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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


    use ChangelogTrait;

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
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return InvoiceTemplateDto
     */
    public static function createDto($id = null)
    {
        return new InvoiceTemplateDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return InvoiceTemplateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, InvoiceTemplateInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto InvoiceTemplateDto
         */
        Assertion::isInstanceOf($dto, InvoiceTemplateDto::class);

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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto InvoiceTemplateDto
         */
        Assertion::isInstanceOf($dto, InvoiceTemplateDto::class);

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
     * @param int $depth
     * @return InvoiceTemplateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName($this->getName())
            ->setDescription($this->getDescription())
            ->setTemplate($this->getTemplate())
            ->setTemplateHeader($this->getTemplateHeader())
            ->setTemplateFooter($this->getTemplateFooter())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth));
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

