<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @return array
     */
    public function getChangeSet(): array;

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

    public function getName(): string;

    public function getUnit(): string;

    public function getFrequency(): int;

    public function getEmail(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastExecution(): ?\DateTimeInterface;

    public function getLastExecutionError(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getNextExecution(): ?\DateTimeInterface;

    public function getTaxRate(): ?float;

    public function getInvoiceTemplate(): ?InvoiceTemplateInterface;

    public function getBrand(): BrandInterface;

    public function getCompany(): CompanyInterface;

    public function getNumberSequence(): ?InvoiceNumberSequenceInterface;

    public function isInitialized(): bool;

    public function addRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    public function removeRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts): InvoiceSchedulerInterface;

    public function getRelFixedCosts(?Criteria $criteria = null): array;
}
