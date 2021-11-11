<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

/**
* DdiProviderAddressAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderAddressAbstract
{
    use ChangelogTrait;

    protected $ip;

    protected $description;

    /**
     * @var DdiProviderInterface
     * inversedBy ddiProviderAddresses
     */
    protected $ddiProvider;

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
            "DdiProviderAddress",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DdiProviderAddressDto
    {
        return new DdiProviderAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DdiProviderAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiProviderAddressDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DdiProviderAddressInterface::class);

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
     * @param DdiProviderAddressDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiProviderAddressDto::class);

        $self = new static();

        $self
            ->setIp($dto->getIp())
            ->setDescription($dto->getDescription())
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiProviderAddressDto::class);

        $this
            ->setIp($dto->getIp())
            ->setDescription($dto->getDescription())
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderAddressDto
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setDescription(self::getDescription())
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'ip' => self::getIp(),
            'description' => self::getDescription(),
            'ddiProviderId' => self::getDdiProvider()->getId()
        ];
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

    public function setDdiProvider(DdiProviderInterface $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): DdiProviderInterface
    {
        return $this->ddiProvider;
    }
}
