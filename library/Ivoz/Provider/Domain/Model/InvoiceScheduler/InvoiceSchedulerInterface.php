<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface InvoiceSchedulerInterface extends SchedulerInterface, LoggableEntityInterface
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
    public function setEmail($email);

    /**
     * @inheritdoc
     */
    public function setFrequency($frequency);

    public function getSchedulerDateTimeZone();

    /**
     * @return \DateInterval
     */
    public function getInterval();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit();

    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get lastExecution
     *
     * @return \DateTime | null
     */
    public function getLastExecution();

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError();

    /**
     * Get nextExecution
     *
     * @return \DateTime | null
     */
    public function getNextExecution();

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate();

    /**
     * Set invoiceTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate | null
     *
     * @return static
     */
    public function setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate = null);

    /**
     * Get invoiceTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set numberSequence
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence | null
     *
     * @return static
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence = null);

    /**
     * Get numberSequence
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence();

    /**
     * Add relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $relFixedCost
     *
     * @return static
     */
    public function addRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $relFixedCost);

    /**
     * Remove relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $relFixedCost
     */
    public function removeRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $relFixedCost);

    /**
     * Replace relFixedCosts
     *
     * @param ArrayCollection $relFixedCosts of Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface
     * @return static
     */
    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts);

    /**
     * Get relFixedCosts
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface[]
     */
    public function getRelFixedCosts(\Doctrine\Common\Collections\Criteria $criteria = null);
}
