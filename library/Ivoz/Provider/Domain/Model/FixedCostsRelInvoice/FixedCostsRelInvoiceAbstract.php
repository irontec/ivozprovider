<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCost;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;

/**
* FixedCostsRelInvoiceAbstract
* @codeCoverageIgnore
*/
abstract class FixedCostsRelInvoiceAbstract
{
    use ChangelogTrait;

    /**
     * @var int | null
     */
    protected $quantity;

    /**
     * @var FixedCostInterface
     */
    protected $fixedCost;

    /**
     * @var InvoiceInterface
     * inversedBy relFixedCosts
     */
    protected $invoice;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceInterface|null $entity
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

        /** @var FixedCostsRelInvoiceDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceDto::class);

        $self = new static(

        );

        $self
            ->setQuantity($dto->getQuantity())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FixedCostsRelInvoiceDto::class);

        $this
            ->setQuantity($dto->getQuantity())
            ->setFixedCost($fkTransformer->transform($dto->getFixedCost()))
            ->setInvoice($fkTransformer->transform($dto->getInvoice()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FixedCostsRelInvoiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setQuantity(self::getQuantity())
            ->setFixedCost(FixedCost::entityToDto(self::getFixedCost(), $depth))
            ->setInvoice(Invoice::entityToDto(self::getInvoice(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'quantity' => self::getQuantity(),
            'fixedCostId' => self::getFixedCost()->getId(),
            'invoiceId' => self::getInvoice() ? self::getInvoice()->getId() : null
        ];
    }

    /**
     * Set quantity
     *
     * @param int $quantity | null
     *
     * @return static
     */
    protected function setQuantity(?int $quantity = null): FixedCostsRelInvoiceInterface
    {
        if (!is_null($quantity)) {
            Assertion::greaterOrEqualThan($quantity, 0, 'quantity provided "%s" is not greater or equal than "%s".');
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int | null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Set fixedCost
     *
     * @param FixedCostInterface
     *
     * @return static
     */
    protected function setFixedCost(FixedCostInterface $fixedCost): FixedCostsRelInvoiceInterface
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    /**
     * Get fixedCost
     *
     * @return FixedCostInterface
     */
    public function getFixedCost(): FixedCostInterface
    {
        return $this->fixedCost;
    }

    /**
     * Set invoice
     *
     * @param InvoiceInterface | null
     *
     * @return static
     */
    public function setInvoice(?InvoiceInterface $invoice = null): FixedCostsRelInvoiceInterface
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return InvoiceInterface | null
     */
    public function getInvoice(): ?InvoiceInterface
    {
        return $this->invoice;
    }

}
