<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;

/**
* DispatcherAbstract
* @codeCoverageIgnore
*/
abstract class DispatcherAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     */
    protected $setid = 0;

    /**
     * @var string
     */
    protected $destination = '';

    /**
     * @var int
     */
    protected $flags = 0;

    /**
     * @var int
     */
    protected $priority = 0;

    /**
     * @var string
     */
    protected $attrs = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var ApplicationServerInterface
     */
    protected $applicationServer;

    /**
     * Constructor
     */
    protected function __construct(
        int $setid,
        string $destination,
        int $flags,
        int $priority,
        string $attrs,
        string $description
    ) {
        $this->setSetid($setid);
        $this->setDestination($destination);
        $this->setFlags($flags);
        $this->setPriority($priority);
        $this->setAttrs($attrs);
        $this->setDescription($description);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Dispatcher",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DispatcherDto
    {
        return new DispatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DispatcherInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DispatcherDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DispatcherInterface::class);

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
     * @param DispatcherDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DispatcherDto::class);
        $setid = $dto->getSetid();
        Assertion::notNull($setid, 'getSetid value is null, but non null value was expected.');
        $destination = $dto->getDestination();
        Assertion::notNull($destination, 'getDestination value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $attrs = $dto->getAttrs();
        Assertion::notNull($attrs, 'getAttrs value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $applicationServer = $dto->getApplicationServer();
        Assertion::notNull($applicationServer, 'getApplicationServer value is null, but non null value was expected.');

        $self = new static(
            $setid,
            $destination,
            $flags,
            $priority,
            $attrs,
            $description
        );

        $self
            ->setApplicationServer($fkTransformer->transform($applicationServer));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DispatcherDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DispatcherDto::class);

        $setid = $dto->getSetid();
        Assertion::notNull($setid, 'getSetid value is null, but non null value was expected.');
        $destination = $dto->getDestination();
        Assertion::notNull($destination, 'getDestination value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $attrs = $dto->getAttrs();
        Assertion::notNull($attrs, 'getAttrs value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $applicationServer = $dto->getApplicationServer();
        Assertion::notNull($applicationServer, 'getApplicationServer value is null, but non null value was expected.');

        $this
            ->setSetid($setid)
            ->setDestination($destination)
            ->setFlags($flags)
            ->setPriority($priority)
            ->setAttrs($attrs)
            ->setDescription($description)
            ->setApplicationServer($fkTransformer->transform($applicationServer));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DispatcherDto
    {
        return self::createDto()
            ->setSetid(self::getSetid())
            ->setDestination(self::getDestination())
            ->setFlags(self::getFlags())
            ->setPriority(self::getPriority())
            ->setAttrs(self::getAttrs())
            ->setDescription(self::getDescription())
            ->setApplicationServer(ApplicationServer::entityToDto(self::getApplicationServer(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'setid' => self::getSetid(),
            'destination' => self::getDestination(),
            'flags' => self::getFlags(),
            'priority' => self::getPriority(),
            'attrs' => self::getAttrs(),
            'description' => self::getDescription(),
            'applicationServerId' => self::getApplicationServer()->getId()
        ];
    }

    protected function setSetid(int $setid): static
    {
        $this->setid = $setid;

        return $this;
    }

    public function getSetid(): int
    {
        return $this->setid;
    }

    protected function setDestination(string $destination): static
    {
        Assertion::maxLength($destination, 192, 'destination value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    protected function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    protected function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    protected function setAttrs(string $attrs): static
    {
        Assertion::maxLength($attrs, 128, 'attrs value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->attrs = $attrs;

        return $this;
    }

    public function getAttrs(): string
    {
        return $this->attrs;
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 64, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setApplicationServer(ApplicationServerInterface $applicationServer): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ApplicationServerInterface
    {
        return $this->applicationServer;
    }
}
