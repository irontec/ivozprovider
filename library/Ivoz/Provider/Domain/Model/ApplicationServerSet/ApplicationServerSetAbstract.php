<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ApplicationServerSetAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     * comment: enum:rr|hash
     */
    protected $distributeMethod = 'hash';

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $distributeMethod
    ) {
        $this->setName($name);
        $this->setDistributeMethod($distributeMethod);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ApplicationServerSet",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ApplicationServerSetDto
    {
        return new ApplicationServerSetDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ApplicationServerSetInterface::class);

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
     * @param ApplicationServerSetDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $distributeMethod = $dto->getDistributeMethod();
        Assertion::notNull($distributeMethod, 'getDistributeMethod value is null, but non null value was expected.');

        $self = new static(
            $name,
            $distributeMethod
        );

        $self
            ->setDescription($dto->getDescription());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ApplicationServerSetDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $distributeMethod = $dto->getDistributeMethod();
        Assertion::notNull($distributeMethod, 'getDistributeMethod value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDistributeMethod($distributeMethod)
            ->setDescription($dto->getDescription());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDistributeMethod(self::getDistributeMethod())
            ->setDescription(self::getDescription());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'distributeMethod' => self::getDistributeMethod(),
            'description' => self::getDescription()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 32, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDistributeMethod(string $distributeMethod): static
    {
        Assertion::maxLength($distributeMethod, 25, 'distributeMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $distributeMethod,
            [
                ApplicationServerSetInterface::DISTRIBUTEMETHOD_RR,
                ApplicationServerSetInterface::DISTRIBUTEMETHOD_HASH,
            ],
            'distributeMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    public function getDistributeMethod(): string
    {
        return $this->distributeMethod;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 200, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
