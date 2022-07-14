<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

/**
* FixedCostsRelInvoiceInterface
*/
interface FixedCostsRelInvoiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): FixedCostsRelInvoiceDto;

    /**
     * @internal use EntityTools instead
     * @param null|FixedCostsRelInvoiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FixedCostsRelInvoiceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FixedCostsRelInvoiceDto;

    public function getQuantity(): ?int;

    public function getFixedCost(): FixedCostInterface;

    public function setInvoice(?InvoiceInterface $invoice = null): static;

    public function getInvoice(): ?InvoiceInterface;

    public function isInitialized(): bool;
}
