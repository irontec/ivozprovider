<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;

/**
* FixedCostsRelInvoiceSchedulerDtoAbstract
* @codeCoverageIgnore
*/
abstract class FixedCostsRelInvoiceSchedulerDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int | null
     */
    private $quantity;

    /**
     * @var int
     */
    private $id;

    /**
     * @var FixedCostDto | null
     */
    private $fixedCost;

    /**
     * @var InvoiceSchedulerDto | null
     */
    private $invoiceScheduler;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
            'quantity' => $this->getQuantity(),
            'id' => $this->getId(),
            'fixedCost' => $this->getFixedCost(),
            'invoiceScheduler' => $this->getInvoiceScheduler()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param int $quantity | null
     *
     * @return static
     */
    public function setQuantity(?int $quantity = null): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param FixedCostDto | null
     *
     * @return static
     */
    public function setFixedCost(?FixedCostDto $fixedCost = null): self
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    /**
     * @return FixedCostDto | null
     */
    public function getFixedCost(): ?FixedCostDto
    {
        return $this->fixedCost;
    }

    /**
     * @return static
     */
    public function setFixedCostId($id): self
    {
        $value = !is_null($id)
            ? new FixedCostDto($id)
            : null;

        return $this->setFixedCost($value);
    }

    /**
     * @return mixed | null
     */
    public function getFixedCostId()
    {
        if ($dto = $this->getFixedCost()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param InvoiceSchedulerDto | null
     *
     * @return static
     */
    public function setInvoiceScheduler(?InvoiceSchedulerDto $invoiceScheduler = null): self
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    /**
     * @return InvoiceSchedulerDto | null
     */
    public function getInvoiceScheduler(): ?InvoiceSchedulerDto
    {
        return $this->invoiceScheduler;
    }

    /**
     * @return static
     */
    public function setInvoiceSchedulerId($id): self
    {
        $value = !is_null($id)
            ? new InvoiceSchedulerDto($id)
            : null;

        return $this->setInvoiceScheduler($value);
    }

    /**
     * @return mixed | null
     */
    public function getInvoiceSchedulerId()
    {
        if ($dto = $this->getInvoiceScheduler()) {
            return $dto->getId();
        }

        return null;
    }

}
