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
     * @var \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    protected $fixedCost;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface
     */
    protected $invoiceScheduler;


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
     * @param EntityInterface|null $entity
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
         * @var $dto FixedCostsRelInvoiceSchedulerDto
         */
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);

        $self = new static();

        $self
            ->setQuantity($dto->getQuantity())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()))
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
         * @var $dto FixedCostsRelInvoiceSchedulerDto
         */
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceSchedulerDto::class);

        $this
            ->setQuantity($dto->getQuantity())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoiceScheduler($fkTransformer->transform($dto->getInvoiceScheduler()));



        $this->sanitizeValues();
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
            ->setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCost::entityToDto(self::getFixedCost(), $depth))
            ->setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler::entityToDto(self::getInvoiceScheduler(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'quantity' => self::getQuantity(),
            'fixedCostId' => self::getFixedCost() ? self::getFixedCost()->getId() : null,
            'invoiceSchedulerId' => self::getInvoiceScheduler() ? self::getInvoiceScheduler()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return self
     */
    protected function setQuantity($quantity = null)
    {
        if (!is_null($quantity)) {
            if (!is_null($quantity)) {
                Assertion::integerish($quantity, 'quantity value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($quantity, 0, 'quantity provided "%s" is not greater or equal than "%s".');
                $quantity = (int) $quantity;
            }
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
     * Set fixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface $fixedCost
     *
     * @return self
     */
    public function setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface $fixedCost)
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
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler
     *
     * @return self
     */
    public function setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler = null)
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    /**
     * Get invoiceScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface
     */
    public function getInvoiceScheduler()
    {
        return $this->invoiceScheduler;
    }

    // @codeCoverageIgnoreEnd
}
