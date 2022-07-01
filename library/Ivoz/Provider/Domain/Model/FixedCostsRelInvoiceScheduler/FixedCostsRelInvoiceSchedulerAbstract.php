<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FixedCostsRelInvoiceSchedulerAbstract
 * @codeCoverageIgnore
 */
abstract class FixedCostsRelInvoiceSchedulerAbstract
{
    /**
     * @var integer | null
     */
    protected $quantity;

    /**
     * comment: enum:static|maxcalls|ddis
     * @var string
     */
    protected $type = 'static';

    /**
     * @var \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    protected $fixedCost;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    protected $invoiceScheduler;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $country;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($type)
    {
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "FixedCostsRelInvoiceScheduler",
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
     * @return FixedCostsRelInvoiceSchedulerDto
     */
    public static function createDto($id = null)
    {
        return new FixedCostsRelInvoiceSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceSchedulerInterface|null $entity
     * @param int $depth
     * @return FixedCostsRelInvoiceSchedulerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FixedCostsRelInvoiceSchedulerInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FixedCostsRelInvoiceSchedulerDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceSchedulerDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);

        $self = new static(
            $dto->getType()
        );

        $self
            ->setQuantity($dto->getQuantity())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceSchedulerDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);

        $this
            ->setQuantity($dto->getQuantity())
            ->setType($dto->getType())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setCountry($fkTransformer->transform($dto->getCountry()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FixedCostsRelInvoiceSchedulerDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setQuantity(self::getQuantity())
            ->setType(self::getType())
            ->setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCost::entityToDto(self::getFixedCost(), $depth))
            ->setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::entityToDto(self::getInvoiceScheduler(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'quantity' => self::getQuantity(),
            'type' => self::getType(),
            'fixedCostId' => self::getFixedCost()->getId(),
            'invoiceSchedulerId' => self::getInvoiceScheduler() ? self::getInvoiceScheduler()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set quantity
     *
     * @param integer $quantity | null
     *
     * @return static
     */
    protected function setQuantity($quantity = null)
    {
        if (!is_null($quantity)) {
            Assertion::integerish($quantity, 'quantity value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($quantity, 0, 'quantity provided "%s" is not greater or equal than "%s".');
            $quantity = (int) $quantity;
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer | null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, [
            FixedCostsRelInvoiceSchedulerInterface::TYPE_STATIC,
            FixedCostsRelInvoiceSchedulerInterface::TYPE_MAXCALLS,
            FixedCostsRelInvoiceSchedulerInterface::TYPE_DDIS
        ], 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set fixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface $fixedCost
     *
     * @return static
     */
    protected function setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface $fixedCost)
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    /**
     * Get fixedCost
     *
     * @return \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    public function getFixedCost()
    {
        return $this->fixedCost;
    }

    /**
     * Set invoiceScheduler
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler | null
     *
     * @return static
     */
    public function setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler = null)
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    /**
     * Get invoiceScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    public function getInvoiceScheduler()
    {
        return $this->invoiceScheduler;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country | null
     *
     * @return static
     */
    protected function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    // @codeCoverageIgnoreEnd
}
