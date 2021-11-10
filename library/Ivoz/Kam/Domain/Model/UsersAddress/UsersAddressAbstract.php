<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* UsersAddressAbstract
* @codeCoverageIgnore
*/
abstract class UsersAddressAbstract
{
    use ChangelogTrait;

    /**
     * column: source_address
     */
    protected $sourceAddress;

    /**
     * column: ip_addr
     */
    protected $ipAddr;

    protected $mask = 32;

    protected $port = 0;

    protected $tag;

    protected $description;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        string $sourceAddress,
        int $mask,
        int $port
    ) {
        $this->setSourceAddress($sourceAddress);
        $this->setMask($mask);
        $this->setPort($port);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersAddress",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersAddressDto
    {
        return new UsersAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersAddressDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersAddressInterface::class);

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
     * @param UsersAddressDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $self = new static(
            $dto->getSourceAddress(),
            $dto->getMask(),
            $dto->getPort()
        );

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersAddressDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $this
            ->setSourceAddress($dto->getSourceAddress())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersAddressDto
    {
        return self::createDto()
            ->setSourceAddress(self::getSourceAddress())
            ->setIpAddr(self::getIpAddr())
            ->setMask(self::getMask())
            ->setPort(self::getPort())
            ->setTag(self::getTag())
            ->setDescription(self::getDescription())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'source_address' => self::getSourceAddress(),
            'ip_addr' => self::getIpAddr(),
            'mask' => self::getMask(),
            'port' => self::getPort(),
            'tag' => self::getTag(),
            'description' => self::getDescription(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    protected function setSourceAddress(string $sourceAddress): static
    {
        Assertion::maxLength($sourceAddress, 100, 'sourceAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sourceAddress = $sourceAddress;

        return $this;
    }

    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
    }

    protected function setIpAddr(?string $ipAddr = null): static
    {
        if (!is_null($ipAddr)) {
            Assertion::maxLength($ipAddr, 50, 'ipAddr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ipAddr = $ipAddr;

        return $this;
    }

    public function getIpAddr(): ?string
    {
        return $this->ipAddr;
    }

    protected function setMask(int $mask): static
    {
        $this->mask = $mask;

        return $this;
    }

    public function getMask(): int
    {
        return $this->mask;
    }

    protected function setPort(int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    protected function setTag(?string $tag = null): static
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
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

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }
}
