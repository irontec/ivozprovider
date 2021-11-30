<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;

/**
* FixedCostsRelInvoiceDtoAbstract
* @codeCoverageIgnore
*/
abstract class FixedCostsRelInvoiceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $quantity = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var FixedCostDto | null
     */
    private $fixedCost = null;

    /**
     * @var InvoiceDto | null
     */
    private $invoice = null;

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
            'id' => 'id',
            'fixedCostId' => 'fixedCost',
            'invoiceId' => 'invoice'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'quantity' => $this->getQuantity(),
            'id' => $this->getId(),
            'fixedCost' => $this->getFixedCost(),
            'invoice' => $this->getInvoice()
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

    public function setInvoice(?InvoiceDto $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getInvoice(): ?InvoiceDto
    {
        return $this->invoice;
    }

    public function setInvoiceId($id): static
    {
        $value = !is_null($id)
            ? new InvoiceDto($id)
            : null;

        return $this->setInvoice($value);
    }

    public function getInvoiceId()
    {
        if ($dto = $this->getInvoice()) {
            return $dto->getId();
        }

        return null;
    }
}
