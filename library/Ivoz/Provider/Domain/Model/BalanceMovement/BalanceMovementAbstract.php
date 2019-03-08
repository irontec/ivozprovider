<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BalanceMovementAbstract
 * @codeCoverageIgnore
 */
abstract class BalanceMovementAbstract
{
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
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;


    use ChangelogTrait;

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
     * @param null $id
     * @return BalanceMovementDto
     */
    public static function createDto($id = null)
    {
        return new BalanceMovementDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto BalanceMovementDto
         */
        Assertion::isInstanceOf($dto, BalanceMovementDto::class);

        $self = new static();

        $self
            ->setAmount($dto->getAmount())
            ->setBalance($dto->getBalance())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto BalanceMovementDto
         */
        Assertion::isInstanceOf($dto, BalanceMovementDto::class);

        $this
            ->setAmount($dto->getAmount())
            ->setBalance($dto->getBalance())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));



        $this->sanitizeValues();
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return self
     */
    protected function setAmount($amount = null)
    {
        if (!is_null($amount)) {
            if (!is_null($amount)) {
                Assertion::numeric($amount);
                $amount = (float) $amount;
            }
        }

        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float | null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return self
     */
    protected function setBalance($balance = null)
    {
        if (!is_null($balance)) {
            if (!is_null($balance)) {
                Assertion::numeric($balance);
                $balance = (float) $balance;
            }
        }

        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    protected function setCreatedOn($createdOn = null)
    {
        if (!is_null($createdOn)) {
            $createdOn = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $createdOn,
                'CURRENT_TIMESTAMP'
            );
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime | null
     */
    public function getCreatedOn()
    {
        return !is_null($this->createdOn) ? clone $this->createdOn : null;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    // @codeCoverageIgnoreEnd
}
