<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class FixedCostsRelInvoiceSchedulerDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto | null
     */
    private $fixedCost;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto | null
     */
    private $invoiceScheduler;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'quantity' => 'quantity',
            'id' => 'id',
            'fixedCostId' => 'fixedCost',
            'invoiceSchedulerId' => 'invoiceScheduler'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'quantity' => $this->getQuantity(),
            'id' => $this->getId(),
            'fixedCost' => $this->getFixedCost(),
            'invoiceScheduler' => $this->getInvoiceScheduler()
        ];
    }

    /**
     * @param integer $quantity
     *
     * @return static
     */
    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto $fixedCost
     *
     * @return static
     */
    public function setFixedCost(\Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto $fixedCost = null)
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto
     */
    public function getFixedCost()
    {
        return $this->fixedCost;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFixedCostId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto($id)
            : null;

        return $this->setFixedCost($value);
    }

    /**
     * @return integer | null
     */
    public function getFixedCostId()
    {
        if ($dto = $this->getFixedCost()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto $invoiceScheduler
     *
     * @return static
     */
    public function setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto $invoiceScheduler = null)
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto
     */
    public function getInvoiceScheduler()
    {
        return $this->invoiceScheduler;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setInvoiceSchedulerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto($id)
            : null;

        return $this->setInvoiceScheduler($value);
    }

    /**
     * @return integer | null
     */
    public function getInvoiceSchedulerId()
    {
        if ($dto = $this->getInvoiceScheduler()) {
            return $dto->getId();
        }

        return null;
    }
}
