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
     * @var int|null
     */
    private $quantity = null;

    /**
     * @var string|null
     */
    private $type = 'static';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var FixedCostDto | null
     */
    private $fixedCost = null;

    /**
     * @var InvoiceSchedulerDto | null
     */
    private $invoiceScheduler = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'quantity' => 'quantity',
            'type' => 'type',
            'id' => 'id',
            'fixedCostId' => 'fixedCost',
            'invoiceSchedulerId' => 'invoiceScheduler'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'quantity' => $this->getQuantity(),
            'type' => $this->getType(),
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

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFixedCost(?FixedCostDto $fixedCost): static
    {
        $this->fixedCost = $fixedCost;

        return $this;
    }

    public function getFixedCost(): ?FixedCostDto
    {
        return $this->fixedCost;
    }

    public function setFixedCostId($id): static
    {
        $value = !is_null($id)
            ? new FixedCostDto($id)
            : null;

        return $this->setFixedCost($value);
    }

    public function getFixedCostId()
    {
        if ($dto = $this->getFixedCost()) {
            return $dto->getId();
        }

        return null;
    }

    public function setInvoiceScheduler(?InvoiceSchedulerDto $invoiceScheduler): static
    {
        $this->invoiceScheduler = $invoiceScheduler;

        return $this;
    }

    public function getInvoiceScheduler(): ?InvoiceSchedulerDto
    {
        return $this->invoiceScheduler;
    }

    public function setInvoiceSchedulerId($id): static
    {
        $value = !is_null($id)
            ? new InvoiceSchedulerDto($id)
            : null;

        return $this->setInvoiceScheduler($value);
    }

    public function getInvoiceSchedulerId()
    {
        if ($dto = $this->getInvoiceScheduler()) {
            return $dto->getId();
        }

        return null;
    }
}
