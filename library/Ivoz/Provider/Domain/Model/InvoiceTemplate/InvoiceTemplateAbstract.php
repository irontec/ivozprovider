<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* InvoiceTemplateAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceTemplateAbstract
{
    use ChangelogTrait;

    protected $name;

    protected $description;

    protected $template;

    protected $templateHeader;

    protected $templateFooter;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $template
    ) {
        $this->setName($name);
        $this->setTemplate($template);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "InvoiceTemplate",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): InvoiceTemplateDto
    {
        return new InvoiceTemplateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceTemplateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceTemplateDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceTemplateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceTemplateDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getTemplate()
        );

        $self
            ->setDescription($dto->getDescription())
            ->setTemplateHeader($dto->getTemplateHeader())
            ->setTemplateFooter($dto->getTemplateFooter())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceTemplateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceTemplateDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTemplate($dto->getTemplate())
            ->setTemplateHeader($dto->getTemplateHeader())
            ->setTemplateFooter($dto->getTemplateFooter())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceTemplateDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTemplate(self::getTemplate())
            ->setTemplateHeader(self::getTemplateHeader())
            ->setTemplateFooter(self::getTemplateFooter())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'template' => self::getTemplate(),
            'templateHeader' => self::getTemplateHeader(),
            'templateFooter' => self::getTemplateFooter(),
            'brandId' => self::getBrand()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 55, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 300, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setTemplate(string $template): static
    {
        Assertion::maxLength($template, 65535, 'template value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->template = $template;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    protected function setTemplateHeader(?string $templateHeader = null): static
    {
        if (!is_null($templateHeader)) {
            Assertion::maxLength($templateHeader, 65535, 'templateHeader value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->templateHeader = $templateHeader;

        return $this;
    }

    public function getTemplateHeader(): ?string
    {
        return $this->templateHeader;
    }

    protected function setTemplateFooter(?string $templateFooter = null): static
    {
        if (!is_null($templateFooter)) {
            Assertion::maxLength($templateFooter, 65535, 'templateFooter value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->templateFooter = $templateFooter;

        return $this;
    }

    public function getTemplateFooter(): ?string
    {
        return $this->templateFooter;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }
}
