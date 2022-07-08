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
     * comment: enum:all|national|international|specific
     * @var string | null
     */
    protected $ddisCountryMatch = 'all';

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
    protected $ddisCountry;


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
            ->setDdisCountryMatch($dto->getDdisCountryMatch())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setDdisCountry($fkTransformer->transform($dto->getDdisCountry()))
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
            ->setDdisCountryMatch($dto->getDdisCountryMatch())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
            ->setDdisCountry($fkTransformer->transform($dto->getDdisCountry()));



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
            ->setDdisCountryMatch(self::getDdisCountryMatch())
            ->setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCost::entityToDto(self::getFixedCost(), $depth))
            ->setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::entityToDto(self::getInvoiceScheduler(), $depth))
            ->setDdisCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getDdisCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'quantity' => self::getQuantity(),
            'type' => self::getType(),
            'ddisCountryMatch' => self::getDdisCountryMatch(),
            'fixedCostId' => self::getFixedCost()->getId(),
            'invoiceSchedulerId' => self::getInvoiceScheduler() ? self::getInvoiceScheduler()->getId() : null,
            'ddisCountryId' => self::getDdisCountry() ? self::getDdisCountry()->getId() : null
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
     * Set ddisCountryMatch
     *
     * @param string $ddisCountryMatch | null
     *
     * @return static
     */
    protected function setDdisCountryMatch($ddisCountryMatch = null)
    {
        if (!is_null($ddisCountryMatch)) {
            Assertion::maxLength($ddisCountryMatch, 25, 'ddisCountryMatch value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($ddisCountryMatch, [
                FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_ALL,
                FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_NATIONAL,
                FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_INTERNATIONAL,
                FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_SPECIFIC
            ], 'ddisCountryMatchvalue "%s" is not an element of the valid values: %s');
        }

        $this->ddisCountryMatch = $ddisCountryMatch;

        return $this;
    }

    /**
     * Get ddisCountryMatch
     *
     * @return string | null
     */
    public function getDdisCountryMatch()
    {
        return $this->ddisCountryMatch;
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
     * Set ddisCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $ddisCountry | null
     *
     * @return static
     */
    protected function setDdisCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $ddisCountry = null)
    {
        $this->ddisCountry = $ddisCountry;

        return $this;
    }

    /**
     * Get ddisCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getDdisCountry()
    {
        return $this->ddisCountry;
    }

    // @codeCoverageIgnoreEnd
}
