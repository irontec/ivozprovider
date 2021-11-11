<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* BannedAddressAbstract
* @codeCoverageIgnore
*/
abstract class BannedAddressAbstract
{
    use ChangelogTrait;

    protected $ip;

    /**
     * comment: enum:antiflood|ipfilter|antibruteforce
     */
    protected $blocker;

    protected $aor;

    protected $description;

    protected $lastTimeBanned;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

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
            "BannedAddress",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): BannedAddressDto
    {
        return new BannedAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|BannedAddressInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BannedAddressDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BannedAddressInterface::class);

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
     * @param BannedAddressDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $self = new static();

        $self
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setAor($dto->getAor())
            ->setDescription($dto->getDescription())
            ->setLastTimeBanned($dto->getLastTimeBanned())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BannedAddressDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $this
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setAor($dto->getAor())
            ->setDescription($dto->getDescription())
            ->setLastTimeBanned($dto->getLastTimeBanned())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BannedAddressDto
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setBlocker(self::getBlocker())
            ->setAor(self::getAor())
            ->setDescription(self::getDescription())
            ->setLastTimeBanned(self::getLastTimeBanned())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'ip' => self::getIp(),
            'blocker' => self::getBlocker(),
            'aor' => self::getAor(),
            'description' => self::getDescription(),
            'lastTimeBanned' => self::getLastTimeBanned(),
            'brandId' => self::getBrand()?->getId(),
            'companyId' => self::getCompany()?->getId()
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

    protected function setBlocker(?string $blocker = null): static
    {
        if (!is_null($blocker)) {
            Assertion::maxLength($blocker, 50, 'blocker value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $blocker,
                [
                    BannedAddressInterface::BLOCKER_ANTIFLOOD,
                    BannedAddressInterface::BLOCKER_IPFILTER,
                    BannedAddressInterface::BLOCKER_ANTIBRUTEFORCE,
                ],
                'blockervalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->blocker = $blocker;

        return $this;
    }

    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    protected function setAor(?string $aor = null): static
    {
        if (!is_null($aor)) {
            Assertion::maxLength($aor, 300, 'aor value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->aor = $aor;

        return $this;
    }

    public function getAor(): ?string
    {
        return $this->aor;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 100, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setLastTimeBanned($lastTimeBanned = null): static
    {
        if (!is_null($lastTimeBanned)) {
            Assertion::notNull(
                $lastTimeBanned,
                'lastTimeBanned value "%s" is null, but non null value was expected.'
            );
            $lastTimeBanned = DateTimeHelper::createOrFix(
                $lastTimeBanned,
                null
            );

            if ($this->lastTimeBanned == $lastTimeBanned) {
                return $this;
            }
        }

        $this->lastTimeBanned = $lastTimeBanned;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastTimeBanned(): ?\DateTimeInterface
    {
        return !is_null($this->lastTimeBanned) ? clone $this->lastTimeBanned : null;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }
}
