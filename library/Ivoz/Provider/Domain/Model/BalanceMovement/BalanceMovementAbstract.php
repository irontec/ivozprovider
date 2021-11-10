<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

/**
* BalanceMovementAbstract
* @codeCoverageIgnore
*/
abstract class BalanceMovementAbstract
{
    use ChangelogTrait;

    protected $amount = 0;

    protected $balance = 0;

    protected $createdOn;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * @var CarrierInterface | null
     */
    protected $carrier;

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
            "BalanceMovement",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): BalanceMovementDto
    {
        return new BalanceMovementDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|BalanceMovementInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BalanceMovementDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BalanceMovementInterface::class);

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
     * @param BalanceMovementDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BalanceMovementDto::class);

        $self = new static();

        $self
            ->setAmount($dto->getAmount())
            ->setBalance($dto->getBalance())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BalanceMovementDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BalanceMovementDto::class);

        $this
            ->setAmount($dto->getAmount())
            ->setBalance($dto->getBalance())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BalanceMovementDto
    {
        return self::createDto()
            ->setAmount(self::getAmount())
            ->setBalance(self::getBalance())
            ->setCreatedOn(self::getCreatedOn())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'amount' => self::getAmount(),
            'balance' => self::getBalance(),
            'createdOn' => self::getCreatedOn(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null
        ];
    }

    protected function setAmount(?float $amount = null): static
    {
        if (!is_null($amount)) {
            $amount = (float) $amount;
        }

        $this->amount = $amount;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    protected function setBalance(?float $balance = null): static
    {
        if (!is_null($balance)) {
            $balance = (float) $balance;
        }

        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    protected function setCreatedOn($createdOn = null): static
    {
        if (!is_null($createdOn)) {
            Assertion::notNull(
                $createdOn,
                'createdOn value "%s" is null, but non null value was expected.'
            );
            $createdOn = DateTimeHelper::createOrFix(
                $createdOn,
                'CURRENT_TIMESTAMP'
            );

            if ($this->createdOn == $createdOn) {
                return $this;
            }
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): ?\DateTimeInterface
    {
        return !is_null($this->createdOn) ? clone $this->createdOn : null;
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

    protected function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }
}
