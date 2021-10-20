<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* CommandlogAbstract
* @codeCoverageIgnore
*/
abstract class CommandlogAbstract
{
    use ChangelogTrait;

    protected $requestId;

    protected $class;

    protected $method;

    protected $arguments = [];

    protected $agent = [];

    protected $createdOn;

    protected $microtime;

    /**
     * Constructor
     */
    protected function __construct(
        string $requestId,
        string $class,
        \DateTimeInterface|string $createdOn,
        int $microtime
    ) {
        $this->setRequestId($requestId);
        $this->setClass($class);
        $this->setCreatedOn($createdOn);
        $this->setMicrotime($microtime);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Commandlog",
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
     */
    public static function createDto($id = null): CommandlogDto
    {
        return new CommandlogDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CommandlogInterface|null $entity
     * @param int $depth
     * @return CommandlogDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CommandlogInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CommandlogDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CommandlogDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CommandlogDto::class);

        $self = new static(
            $dto->getRequestId(),
            $dto->getClass(),
            $dto->getCreatedOn(),
            $dto->getMicrotime()
        );

        $self
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
            ->setAgent($dto->getAgent());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CommandlogDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CommandlogDto::class);

        $this
            ->setRequestId($dto->getRequestId())
            ->setClass($dto->getClass())
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
            ->setAgent($dto->getAgent())
            ->setCreatedOn($dto->getCreatedOn())
            ->setMicrotime($dto->getMicrotime());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): CommandlogDto
    {
        return self::createDto()
            ->setRequestId(self::getRequestId())
            ->setClass(self::getClass())
            ->setMethod(self::getMethod())
            ->setArguments(self::getArguments())
            ->setAgent(self::getAgent())
            ->setCreatedOn(self::getCreatedOn())
            ->setMicrotime(self::getMicrotime());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'requestId' => self::getRequestId(),
            'class' => self::getClass(),
            'method' => self::getMethod(),
            'arguments' => self::getArguments(),
            'agent' => self::getAgent(),
            'createdOn' => self::getCreatedOn(),
            'microtime' => self::getMicrotime()
        ];
    }

    protected function setRequestId(string $requestId): static
    {
        $this->requestId = $requestId;

        return $this;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    protected function setClass(string $class): static
    {
        Assertion::maxLength($class, 50, 'class value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->class = $class;

        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    protected function setMethod(?string $method = null): static
    {
        if (!is_null($method)) {
            Assertion::maxLength($method, 64, 'method value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->method = $method;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    protected function setArguments(?array $arguments = null): static
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    protected function setAgent(?array $agent = null): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getAgent(): ?array
    {
        return $this->agent;
    }

    protected function setCreatedOn($createdOn): static
    {

        $createdOn = DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        if ($this->createdOn == $createdOn) {
            return $this;
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface
    {
        return clone $this->createdOn;
    }

    protected function setMicrotime(int $microtime): static
    {
        $this->microtime = $microtime;

        return $this;
    }

    public function getMicrotime(): int
    {
        return $this->microtime;
    }
}
