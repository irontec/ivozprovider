<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
     * @var string
     * column: source_address
     */
    protected $sourceAddress;

    /**
     * @var ?string
     * column: ip_addr
     */
    protected $ipAddr = null;

    /**
     * @var int
     */
    protected $mask = 32;

    /**
     * @var int
     */
    protected $port = 0;

    /**
     * @var ?string
     */
    protected $tag = null;

    /**
     * @var ?string
     */
    protected $description = null;

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
        $sourceAddress = $dto->getSourceAddress();
        Assertion::notNull($sourceAddress, 'getSourceAddress value is null, but non null value was expected.');
        $mask = $dto->getMask();
        Assertion::notNull($mask, 'getMask value is null, but non null value was expected.');
        $port = $dto->getPort();
        Assertion::notNull($port, 'getPort value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $sourceAddress,
            $mask,
            $port
        );

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($company));

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

        $sourceAddress = $dto->getSourceAddress();
        Assertion::notNull($sourceAddress, 'getSourceAddress value is null, but non null value was expected.');
        $mask = $dto->getMask();
        Assertion::notNull($mask, 'getMask value is null, but non null value was expected.');
        $port = $dto->getPort();
        Assertion::notNull($port, 'getPort value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setSourceAddress($sourceAddress)
            ->setIpAddr($dto->getIpAddr())
            ->setMask($mask)
            ->setPort($port)
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($company));

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

    /**
     * @return array<string, mixed>
     */
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
