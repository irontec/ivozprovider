<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* InvoiceSchedulerInterface
*/
interface InvoiceSchedulerInterface extends SchedulerInterface, LoggableEntityInterface
{
    public const UNIT_WEEK = 'week';

    public const UNIT_MONTH = 'month';

    public const UNIT_YEAR = 'year';

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

    /**
     * @inheritdoc
     */
    public function setEmail(string $email): static;

    /**
     * @inheritdoc
     */
    public function setFrequency(int $frequency): static;

    public function getSchedulerDateTimeZone(): \DateTimeZone;

    /**
     * @return \DateInterval
     */
    public function getInterval(): \DateInterval;

    public static function createDto(string|int|null $id = null): InvoiceSchedulerDto;

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceSchedulerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceSchedulerDto;

    public function getName(): string;

    public function getUnit(): string;

    public function getFrequency(): int;

    public function getEmail(): string;

    public function getLastExecution(): ?\DateTime;

    public function getLastExecutionError(): ?string;

    public function getNextExecution(): ?\DateTime;

    public function getTaxRate(): ?float;

    public function getInvoiceTemplate(): ?InvoiceTemplateInterface;

    public function getBrand(): BrandInterface;

    public function getCompany(): CompanyInterface;

    public function getNumberSequence(): ?InvoiceNumberSequenceInterface;

    public function addRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    public function removeRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    /**
     * @param Collection<array-key, FixedCostsRelInvoiceSchedulerInterface> $relFixedCosts
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts): InvoiceSchedulerInterface;

    /**
     * @return array<array-key, FixedCostsRelInvoiceSchedulerInterface>
     */
    public function getRelFixedCosts(?Criteria $criteria = null): array;
}
