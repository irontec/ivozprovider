<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* MediaRelaySetAbstract
* @codeCoverageIgnore
*/
abstract class MediaRelaySetAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name = '0';

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name
    ) {
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "MediaRelaySet",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): MediaRelaySetDto
    {
        return new MediaRelaySetDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|MediaRelaySetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MediaRelaySetDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MediaRelaySetInterface::class);

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
     * @param MediaRelaySetDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MediaRelaySetDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setDescription($dto->getDescription());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MediaRelaySetDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MediaRelaySetDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MediaRelaySetDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription());
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
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
