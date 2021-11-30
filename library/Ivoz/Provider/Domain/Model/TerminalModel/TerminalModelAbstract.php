<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturer;

/**
* TerminalModelAbstract
* @codeCoverageIgnore
*/
abstract class TerminalModelAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var ?string
     */
    protected $genericTemplate = null;

    /**
     * @var ?string
     */
    protected $specificTemplate = null;

    /**
     * @var ?string
     */
    protected $genericUrlPattern = null;

    /**
     * @var ?string
     */
    protected $specificUrlPattern = null;

    /**
     * @var TerminalManufacturerInterface
     */
    protected $terminalManufacturer;

    /**
     * Constructor
     */
    protected function __construct(
        string $iden,
        string $name,
        string $description
    ) {
        $this->setIden($iden);
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TerminalModel",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TerminalModelDto
    {
        return new TerminalModelDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TerminalModelInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TerminalModelDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TerminalModelInterface::class);

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
     * @param TerminalModelDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TerminalModelDto::class);
        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $terminalManufacturer = $dto->getTerminalManufacturer();
        Assertion::notNull($terminalManufacturer, 'getTerminalManufacturer value is null, but non null value was expected.');

        $self = new static(
            $iden,
            $name,
            $description
        );

        $self
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($fkTransformer->transform($terminalManufacturer));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalModelDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TerminalModelDto::class);

        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $terminalManufacturer = $dto->getTerminalManufacturer();
        Assertion::notNull($terminalManufacturer, 'getTerminalManufacturer value is null, but non null value was expected.');

        $this
            ->setIden($iden)
            ->setName($name)
            ->setDescription($description)
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($fkTransformer->transform($terminalManufacturer));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TerminalModelDto
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setGenericTemplate(self::getGenericTemplate())
            ->setSpecificTemplate(self::getSpecificTemplate())
            ->setGenericUrlPattern(self::getGenericUrlPattern())
            ->setSpecificUrlPattern(self::getSpecificUrlPattern())
            ->setTerminalManufacturer(TerminalManufacturer::entityToDto(self::getTerminalManufacturer(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'iden' => self::getIden(),
            'name' => self::getName(),
            'description' => self::getDescription(),
            'genericTemplate' => self::getGenericTemplate(),
            'specificTemplate' => self::getSpecificTemplate(),
            'genericUrlPattern' => self::getGenericUrlPattern(),
            'specificUrlPattern' => self::getSpecificUrlPattern(),
            'terminalManufacturerId' => self::getTerminalManufacturer()->getId()
        ];
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 100, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setGenericTemplate(?string $genericTemplate = null): static
    {
        if (!is_null($genericTemplate)) {
            Assertion::maxLength($genericTemplate, 65535, 'genericTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    public function getGenericTemplate(): ?string
    {
        return $this->genericTemplate;
    }

    protected function setSpecificTemplate(?string $specificTemplate = null): static
    {
        if (!is_null($specificTemplate)) {
            Assertion::maxLength($specificTemplate, 65535, 'specificTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    public function getSpecificTemplate(): ?string
    {
        return $this->specificTemplate;
    }

    protected function setGenericUrlPattern(?string $genericUrlPattern = null): static
    {
        if (!is_null($genericUrlPattern)) {
            Assertion::maxLength($genericUrlPattern, 225, 'genericUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    public function getGenericUrlPattern(): ?string
    {
        return $this->genericUrlPattern;
    }

    protected function setSpecificUrlPattern(?string $specificUrlPattern = null): static
    {
        if (!is_null($specificUrlPattern)) {
            Assertion::maxLength($specificUrlPattern, 225, 'specificUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    public function getSpecificUrlPattern(): ?string
    {
        return $this->specificUrlPattern;
    }

    protected function setTerminalManufacturer(TerminalManufacturerInterface $terminalManufacturer): static
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    public function getTerminalManufacturer(): TerminalManufacturerInterface
    {
        return $this->terminalManufacturer;
    }
}
