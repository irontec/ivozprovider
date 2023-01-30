<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* FixedCostsRelInvoiceSchedulerInterface
*/
interface FixedCostsRelInvoiceSchedulerInterface extends LoggableEntityInterface
{
    public const TYPE_STATIC = 'static';

    public const TYPE_MAXCALLS = 'maxcalls';

    public const TYPE_DDIS = 'ddis';

    public const DDISCOUNTRYMATCH_ALL = 'all';

    public const DDISCOUNTRYMATCH_NATIONAL = 'national';

    public const DDISCOUNTRYMATCH_INTERNATIONAL = 'international';

    public const DDISCOUNTRYMATCH_SPECIFIC = 'specific';

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

    public static function createDto(string|int|null $id = null): FixedCostsRelInvoiceSchedulerDto;

    /**
     * @internal use EntityTools instead
     * @param null|FixedCostsRelInvoiceSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FixedCostsRelInvoiceSchedulerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FixedCostsRelInvoiceSchedulerDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FixedCostsRelInvoiceSchedulerDto;

    public function getQuantity(): ?int;

    public function getType(): string;

    public function getDdisCountryMatch(): ?string;

    public function getFixedCost(): FixedCostInterface;

    public function setInvoiceScheduler(?InvoiceSchedulerInterface $invoiceScheduler = null): static;

    public function getInvoiceScheduler(): ?InvoiceSchedulerInterface;

    public function getDdisCountry(): ?CountryInterface;
}
