<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FixedCostsRelInvoiceAbstract
 * @codeCoverageIgnore
 */
abstract class FixedCostsRelInvoiceAbstract
{
    /**
     * @var integer
     */
    protected $quantity;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    protected $fixedCost;

    /**
     * @var \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    protected $invoice;


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
        return sprintf("%s#%s",
            "FixedCostsRelInvoice",
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
     * @return FixedCostsRelInvoiceDto
     */
    public static function createDto($id = null)
    {
        return new FixedCostsRelInvoiceDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return FixedCostsRelInvoiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FixedCostsRelInvoiceInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FixedCostsRelInvoiceDto
         */
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceDto::class);

        $self = new static();

        $self
            ->setQuantity($dto->getQuantity())
            ->setBrand($dto->getBrand())
            ->setFixedCost($dto->getFixedCost())
            ->setInvoice($dto->getInvoice())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FixedCostsRelInvoiceDto
         */
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceDto::class);

        $this
            ->setQuantity($dto->getQuantity())
            ->setBrand($dto->getBrand())
            ->setFixedCost($dto->getFixedCost())
            ->setInvoice($dto->getInvoice());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return FixedCostsRelInvoiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setQuantity($this->getQuantity())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth))
            ->setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCost::entityToDto($this->getFixedCost(), $depth))
            ->setInvoice(\Ivoz\Provider\Domain\Model\Invoice\Invoice::entityToDto($this->getInvoice(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'quantity' => self::getQuantity(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'fixedCostId' => self::getFixedCost() ? self::getFixedCost()->getId() : null,
            'invoiceId' => self::getInvoice() ? self::getInvoice()->getId() : null
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
    public function setQuantity($quantity = null)
    {
        if (!is_null($quantity)) {
            if (!is_null($quantity)) {
                Assertion::integerish($quantity, 'quantity value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
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
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     *
     * @return self
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface
     */
    public function getInvoice()
    {
        return $this->invoice;
    }



    // @codeCoverageIgnoreEnd
}

