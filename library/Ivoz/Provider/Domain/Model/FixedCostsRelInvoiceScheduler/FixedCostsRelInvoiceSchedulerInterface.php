<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

/**
* FixedCostsRelInvoiceSchedulerInterface
*/
interface FixedCostsRelInvoiceSchedulerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): FixedCostsRelInvoiceSchedulerDto;

    /**
     * @internal use EntityTools instead
     * @param null|FixedCostsRelInvoiceSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FixedCostsRelInvoiceSchedulerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FixedCostsRelInvoiceSchedulerDto;

    public function getQuantity(): ?int;

    public function getFixedCost(): FixedCostInterface;

    public function setInvoiceScheduler(?InvoiceSchedulerInterface $invoiceScheduler = null): static;

    public function getInvoiceScheduler(): ?InvoiceSchedulerInterface;

    public function isInitialized(): bool;
}
