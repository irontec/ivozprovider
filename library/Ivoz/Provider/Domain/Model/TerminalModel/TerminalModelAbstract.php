<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $genericTemplate;

    /**
     * @var string | null
     */
    protected $specificTemplate;

    /**
     * @var string | null
     */
    protected $genericUrlPattern;

    /**
     * @var string | null
     */
    protected $specificUrlPattern;

    /**
     * @var TerminalManufacturerInterface
     */
    protected $terminalManufacturer;

    /**
     * Constructor
     */
    protected function __construct(
        $iden,
        $name,
        $description
    ) {
        $this->setIden($iden);
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TerminalModel",
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
     * @return TerminalModelDto
     */
    public static function createDto($id = null)
    {
        return new TerminalModelDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalModelInterface|null $entity
     * @param int $depth
     * @return TerminalModelDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var TerminalModelDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TerminalModelDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TerminalModelDto::class);

        $self = new static(
            $dto->getIden(),
            $dto->getName(),
            $dto->getDescription()
        );

        $self
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($fkTransformer->transform($dto->getTerminalManufacturer()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalModelDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TerminalModelDto::class);

        $this
            ->setIden($dto->getIden())
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($fkTransformer->transform($dto->getTerminalManufacturer()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TerminalModelDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return static
     */
    protected function setIden(string $iden): TerminalModelInterface
    {
        Assertion::maxLength($iden, 100, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden(): string
    {
        return $this->iden;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): TerminalModelInterface
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): TerminalModelInterface
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set genericTemplate
     *
     * @param string $genericTemplate | null
     *
     * @return static
     */
    protected function setGenericTemplate(?string $genericTemplate = null): TerminalModelInterface
    {
        if (!is_null($genericTemplate)) {
            Assertion::maxLength($genericTemplate, 65535, 'genericTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    /**
     * Get genericTemplate
     *
     * @return string | null
     */
    public function getGenericTemplate(): ?string
    {
        return $this->genericTemplate;
    }

    /**
     * Set specificTemplate
     *
     * @param string $specificTemplate | null
     *
     * @return static
     */
    protected function setSpecificTemplate(?string $specificTemplate = null): TerminalModelInterface
    {
        if (!is_null($specificTemplate)) {
            Assertion::maxLength($specificTemplate, 65535, 'specificTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    /**
     * Get specificTemplate
     *
     * @return string | null
     */
    public function getSpecificTemplate(): ?string
    {
        return $this->specificTemplate;
    }

    /**
     * Set genericUrlPattern
     *
     * @param string $genericUrlPattern | null
     *
     * @return static
     */
    protected function setGenericUrlPattern(?string $genericUrlPattern = null): TerminalModelInterface
    {
        if (!is_null($genericUrlPattern)) {
            Assertion::maxLength($genericUrlPattern, 225, 'genericUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    /**
     * Get genericUrlPattern
     *
     * @return string | null
     */
    public function getGenericUrlPattern(): ?string
    {
        return $this->genericUrlPattern;
    }

    /**
     * Set specificUrlPattern
     *
     * @param string $specificUrlPattern | null
     *
     * @return static
     */
    protected function setSpecificUrlPattern(?string $specificUrlPattern = null): TerminalModelInterface
    {
        if (!is_null($specificUrlPattern)) {
            Assertion::maxLength($specificUrlPattern, 225, 'specificUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    /**
     * Get specificUrlPattern
     *
     * @return string | null
     */
    public function getSpecificUrlPattern(): ?string
    {
        return $this->specificUrlPattern;
    }

    /**
     * Set terminalManufacturer
     *
     * @param TerminalManufacturerInterface
     *
     * @return static
     */
    protected function setTerminalManufacturer(TerminalManufacturerInterface $terminalManufacturer): TerminalModelInterface
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    /**
     * Get terminalManufacturer
     *
     * @return TerminalManufacturerInterface
     */
    public function getTerminalManufacturer(): TerminalManufacturerInterface
    {
        return $this->terminalManufacturer;
    }

}
