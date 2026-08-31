<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ChannelUsage;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* ChannelUsageAbstract
* @codeCoverageIgnore
*/
abstract class ChannelUsageAbstract
{
    use ChangelogTrait;

    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @var int
     */
    protected $peak;

    /**
     * @var float
     */
    protected $avgUsage;

    /**
     * @var int
     */
    protected $closingUsage;

    /**
     * @var int
     */
    protected $maxCallsCompany;

    /**
     * @var int
     */
    protected $maxCallsBrand;

    /**
     * @var int
     */
    protected $blockedByCompanyLimit = 0;

    /**
     * @var int
     */
    protected $blockedByBrandLimit = 0;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $timestamp,
        int $peak,
        float $avgUsage,
        int $closingUsage,
        int $maxCallsCompany,
        int $maxCallsBrand,
        int $blockedByCompanyLimit,
        int $blockedByBrandLimit
    ) {
        $this->setTimestamp($timestamp);
        $this->setPeak($peak);
        $this->setAvgUsage($avgUsage);
        $this->setClosingUsage($closingUsage);
        $this->setMaxCallsCompany($maxCallsCompany);
        $this->setMaxCallsBrand($maxCallsBrand);
        $this->setBlockedByCompanyLimit($blockedByCompanyLimit);
        $this->setBlockedByBrandLimit($blockedByBrandLimit);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ChannelUsage",
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
    public static function createDto($id = null): ChannelUsageDto
    {
        return new ChannelUsageDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ChannelUsageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ChannelUsageDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ChannelUsageInterface::class);

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
     * @param ChannelUsageDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ChannelUsageDto::class);
        $timestamp = $dto->getTimestamp();
        Assertion::notNull($timestamp, 'getTimestamp value is null, but non null value was expected.');
        $peak = $dto->getPeak();
        Assertion::notNull($peak, 'getPeak value is null, but non null value was expected.');
        $avgUsage = $dto->getAvgUsage();
        Assertion::notNull($avgUsage, 'getAvgUsage value is null, but non null value was expected.');
        $closingUsage = $dto->getClosingUsage();
        Assertion::notNull($closingUsage, 'getClosingUsage value is null, but non null value was expected.');
        $maxCallsCompany = $dto->getMaxCallsCompany();
        Assertion::notNull($maxCallsCompany, 'getMaxCallsCompany value is null, but non null value was expected.');
        $maxCallsBrand = $dto->getMaxCallsBrand();
        Assertion::notNull($maxCallsBrand, 'getMaxCallsBrand value is null, but non null value was expected.');
        $blockedByCompanyLimit = $dto->getBlockedByCompanyLimit();
        Assertion::notNull($blockedByCompanyLimit, 'getBlockedByCompanyLimit value is null, but non null value was expected.');
        $blockedByBrandLimit = $dto->getBlockedByBrandLimit();
        Assertion::notNull($blockedByBrandLimit, 'getBlockedByBrandLimit value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $timestamp,
            $peak,
            $avgUsage,
            $closingUsage,
            $maxCallsCompany,
            $maxCallsBrand,
            $blockedByCompanyLimit,
            $blockedByBrandLimit
        );

        $self
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($company));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ChannelUsageDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ChannelUsageDto::class);

        $timestamp = $dto->getTimestamp();
        Assertion::notNull($timestamp, 'getTimestamp value is null, but non null value was expected.');
        $peak = $dto->getPeak();
        Assertion::notNull($peak, 'getPeak value is null, but non null value was expected.');
        $avgUsage = $dto->getAvgUsage();
        Assertion::notNull($avgUsage, 'getAvgUsage value is null, but non null value was expected.');
        $closingUsage = $dto->getClosingUsage();
        Assertion::notNull($closingUsage, 'getClosingUsage value is null, but non null value was expected.');
        $maxCallsCompany = $dto->getMaxCallsCompany();
        Assertion::notNull($maxCallsCompany, 'getMaxCallsCompany value is null, but non null value was expected.');
        $maxCallsBrand = $dto->getMaxCallsBrand();
        Assertion::notNull($maxCallsBrand, 'getMaxCallsBrand value is null, but non null value was expected.');
        $blockedByCompanyLimit = $dto->getBlockedByCompanyLimit();
        Assertion::notNull($blockedByCompanyLimit, 'getBlockedByCompanyLimit value is null, but non null value was expected.');
        $blockedByBrandLimit = $dto->getBlockedByBrandLimit();
        Assertion::notNull($blockedByBrandLimit, 'getBlockedByBrandLimit value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setTimestamp($timestamp)
            ->setPeak($peak)
            ->setAvgUsage($avgUsage)
            ->setClosingUsage($closingUsage)
            ->setMaxCallsCompany($maxCallsCompany)
            ->setMaxCallsBrand($maxCallsBrand)
            ->setBlockedByCompanyLimit($blockedByCompanyLimit)
            ->setBlockedByBrandLimit($blockedByBrandLimit)
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($company));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ChannelUsageDto
    {
        return self::createDto()
            ->setTimestamp(self::getTimestamp())
            ->setPeak(self::getPeak())
            ->setAvgUsage(self::getAvgUsage())
            ->setClosingUsage(self::getClosingUsage())
            ->setMaxCallsCompany(self::getMaxCallsCompany())
            ->setMaxCallsBrand(self::getMaxCallsBrand())
            ->setBlockedByCompanyLimit(self::getBlockedByCompanyLimit())
            ->setBlockedByBrandLimit(self::getBlockedByBrandLimit())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'timestamp' => self::getTimestamp(),
            'peak' => self::getPeak(),
            'avgUsage' => self::getAvgUsage(),
            'closingUsage' => self::getClosingUsage(),
            'maxCallsCompany' => self::getMaxCallsCompany(),
            'maxCallsBrand' => self::getMaxCallsBrand(),
            'blockedByCompanyLimit' => self::getBlockedByCompanyLimit(),
            'blockedByBrandLimit' => self::getBlockedByBrandLimit(),
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    protected function setTimestamp(string|\DateTimeInterface $timestamp): static
    {

        /** @var \DateTime */
        $timestamp = DateTimeHelper::createOrFix(
            $timestamp,
            null
        );

        if ($this->isInitialized() && $this->timestamp == $timestamp) {
            return $this;
        }

        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp(): \DateTime
    {
        return clone $this->timestamp;
    }

    protected function setPeak(int $peak): static
    {
        Assertion::greaterOrEqualThan($peak, 0, 'peak provided "%s" is not greater or equal than "%s".');

        $this->peak = $peak;

        return $this;
    }

    public function getPeak(): int
    {
        return $this->peak;
    }

    protected function setAvgUsage(float $avgUsage): static
    {
        $this->avgUsage = $avgUsage;

        return $this;
    }

    public function getAvgUsage(): float
    {
        return $this->avgUsage;
    }

    protected function setClosingUsage(int $closingUsage): static
    {
        Assertion::greaterOrEqualThan($closingUsage, 0, 'closingUsage provided "%s" is not greater or equal than "%s".');

        $this->closingUsage = $closingUsage;

        return $this;
    }

    public function getClosingUsage(): int
    {
        return $this->closingUsage;
    }

    protected function setMaxCallsCompany(int $maxCallsCompany): static
    {
        Assertion::greaterOrEqualThan($maxCallsCompany, 0, 'maxCallsCompany provided "%s" is not greater or equal than "%s".');

        $this->maxCallsCompany = $maxCallsCompany;

        return $this;
    }

    public function getMaxCallsCompany(): int
    {
        return $this->maxCallsCompany;
    }

    protected function setMaxCallsBrand(int $maxCallsBrand): static
    {
        Assertion::greaterOrEqualThan($maxCallsBrand, 0, 'maxCallsBrand provided "%s" is not greater or equal than "%s".');

        $this->maxCallsBrand = $maxCallsBrand;

        return $this;
    }

    public function getMaxCallsBrand(): int
    {
        return $this->maxCallsBrand;
    }

    protected function setBlockedByCompanyLimit(int $blockedByCompanyLimit): static
    {
        Assertion::greaterOrEqualThan($blockedByCompanyLimit, 0, 'blockedByCompanyLimit provided "%s" is not greater or equal than "%s".');

        $this->blockedByCompanyLimit = $blockedByCompanyLimit;

        return $this;
    }

    public function getBlockedByCompanyLimit(): int
    {
        return $this->blockedByCompanyLimit;
    }

    protected function setBlockedByBrandLimit(int $blockedByBrandLimit): static
    {
        Assertion::greaterOrEqualThan($blockedByBrandLimit, 0, 'blockedByBrandLimit provided "%s" is not greater or equal than "%s".');

        $this->blockedByBrandLimit = $blockedByBrandLimit;

        return $this;
    }

    public function getBlockedByBrandLimit(): int
    {
        return $this->blockedByBrandLimit;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
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
