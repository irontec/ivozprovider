<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    /**
     * @var float | null
     */
    protected $amount = 0;

    /**
     * @var float | null
     */
    protected $balance = 0;

    /**
     * @var \DateTime | null
     */
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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "BalanceMovement",
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
     * @return BalanceMovementDto
     */
    public static function createDto($id = null)
    {
        return new BalanceMovementDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BalanceMovementInterface|null $entity
     * @param int $depth
     * @return BalanceMovementDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var BalanceMovementDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BalanceMovementDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return BalanceMovementDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setAmount(self::getAmount())
            ->setBalance(self::getBalance())
            ->setCreatedOn(self::getCreatedOn())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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

    public function getCreatedOn(): ?\DateTime
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
