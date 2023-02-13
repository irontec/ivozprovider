<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

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
     * @var string|null
     */
    private $ddisCountryMatch = 'all';

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
     * @var CountryDto | null
     */
    private $ddisCountry = null;

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
            'ddisCountryMatch' => 'ddisCountryMatch',
            'id' => 'id',
            'fixedCostId' => 'fixedCost',
            'invoiceSchedulerId' => 'invoiceScheduler',
            'ddisCountryId' => 'ddisCountry'
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
            'ddisCountryMatch' => $this->getDdisCountryMatch(),
            'id' => $this->getId(),
            'fixedCost' => $this->getFixedCost(),
            'invoiceScheduler' => $this->getInvoiceScheduler(),
            'ddisCountry' => $this->getDdisCountry()
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

    public function setDdisCountryMatch(?string $ddisCountryMatch): static
    {
        $this->ddisCountryMatch = $ddisCountryMatch;

        return $this;
    }

    public function getDdisCountryMatch(): ?string
    {
        return $this->ddisCountryMatch;
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

    public function setDdisCountry(?CountryDto $ddisCountry): static
    {
        $this->ddisCountry = $ddisCountry;

        return $this;
    }

    public function getDdisCountry(): ?CountryDto
    {
        return $this->ddisCountry;
    }

    public function setDdisCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setDdisCountry($value);
    }

    public function getDdisCountryId()
    {
        if ($dto = $this->getDdisCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
