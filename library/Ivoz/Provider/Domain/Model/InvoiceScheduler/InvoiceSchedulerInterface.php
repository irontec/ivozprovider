<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* InvoiceSchedulerInterface
*/
interface InvoiceSchedulerInterface extends LoggableEntityInterface
{
    const UNIT_WEEK = 'week';

    const UNIT_MONTH = 'month';

    const UNIT_YEAR = 'year';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @inheritdoc
     */
    public function setEmail(string $email): InvoiceSchedulerInterface;

    /**
     * @inheritdoc
     */
    public function setFrequency(int $frequency): InvoiceSchedulerInterface;

    public function getSchedulerDateTimeZone(): \DateTimeZone;

    /**
     * @return \DateInterval
     */
    public function getInterval();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit(): string;

    /**
     * Get frequency
     *
     * @return int
     */
    public function getFrequency(): int;

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Get lastExecution
     *
     * @return \DateTimeInterface | null
     */
    public function getLastExecution(): ?\DateTimeInterface;

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError(): ?string;

    /**
     * Get nextExecution
     *
     * @return \DateTimeInterface | null
     */
    public function getNextExecution(): ?\DateTimeInterface;

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate(): ?float;

    /**
     * Get invoiceTemplate
     *
     * @return InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate(): ?InvoiceTemplateInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get numberSequence
     *
     * @return InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence(): ?InvoiceNumberSequenceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relFixedCost
     *
     * @param FixedCostsRelInvoiceSchedulerInterface $relFixedCost
     *
     * @return static
     */
    public function addRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    /**
     * Remove relFixedCost
     *
     * @param FixedCostsRelInvoiceSchedulerInterface $relFixedCost
     *
     * @return static
     */
    public function removeRelFixedCost(FixedCostsRelInvoiceSchedulerInterface $relFixedCost): InvoiceSchedulerInterface;

    /**
     * Replace relFixedCosts
     *
     * @param ArrayCollection $relFixedCosts of FixedCostsRelInvoiceSchedulerInterface
     *
     * @return static
     */
    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts): InvoiceSchedulerInterface;

    /**
     * Get relFixedCosts
     * @param Criteria | null $criteria
     * @return FixedCostsRelInvoiceSchedulerInterface[]
     */
    public function getRelFixedCosts(?Criteria $criteria = null): array;

}
