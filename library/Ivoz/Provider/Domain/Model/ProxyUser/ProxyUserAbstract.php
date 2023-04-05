<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ProxyUserAbstract
* @codeCoverageIgnore
*/
abstract class ProxyUserAbstract
{
    use ChangelogTrait;

    /**
     * @var ?string
     */
    protected $name = null;

    /**
     * @var ?string
     */
    protected $ip = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ProxyUser",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ProxyUserDto
    {
        return new ProxyUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ProxyUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ProxyUserDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ProxyUserInterface::class);

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
     * @param ProxyUserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ProxyUserDto::class);

        $self = new static();

        $self
            ->setName($dto->getName())
            ->setIp($dto->getIp());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyUserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ProxyUserDto::class);

        $this
            ->setName($dto->getName())
            ->setIp($dto->getIp());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ProxyUserDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setIp(self::getIp());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'ip' => self::getIp()
        ];
    }

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setIp(?string $ip = null): static
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }
}
