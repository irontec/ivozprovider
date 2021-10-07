<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
        $setid,
        $destination,
        $flags,
        $priority,
        $attrs,
        $description
    ) {
        $this->setSetid($setid);
        $this->setDestination($destination);
        $this->setFlags($flags);
        $this->setPriority($priority);
        $this->setAttrs($attrs);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Dispatcher",
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
     * @param mixed $id
     * @return DispatcherDto
     */
    public static function createDto($id = null)
    {
        return new DispatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DispatcherInterface|null $entity
     * @param int $depth
     * @return DispatcherDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var DispatcherDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DispatcherDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DispatcherDto::class);

        $self = new static(
            $dto->getSetid(),
            $dto->getDestination(),
            $dto->getFlags(),
            $dto->getPriority(),
            $dto->getAttrs(),
            $dto->getDescription()
        );

        $self
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DispatcherDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DispatcherDto::class);

        $this
            ->setSetid($dto->getSetid())
            ->setDestination($dto->getDestination())
            ->setFlags($dto->getFlags())
            ->setPriority($dto->getPriority())
            ->setAttrs($dto->getAttrs())
            ->setDescription($dto->getDescription())
            ->setApplicationServer($fkTransformer->transform($dto->getApplicationServer()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DispatcherDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
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
