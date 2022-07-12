<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FixedCostsRelInvoiceSchedulerInterface extends LoggableEntityInterface
{
    const TYPE_STATIC = 'static';
    const TYPE_MAXCALLS = 'maxcalls';
    const TYPE_DDIS = 'ddis';


    const DDISCOUNTRYMATCH_ALL = 'all';
    const DDISCOUNTRYMATCH_NATIONAL = 'national';
    const DDISCOUNTRYMATCH_INTERNATIONAL = 'international';
    const DDISCOUNTRYMATCH_SPECIFIC = 'specific';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get quantity
     *
     * @return integer | null
     */
    public function getQuantity();

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get ddisCountryMatch
     *
     * @return string | null
     */
    public function getDdisCountryMatch();

    /**
     * Get fixedCost
     *
     * @return \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    public function getFixedCost();

    /**
     * Set invoiceScheduler
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler | null
     *
     * @return static
     */
    public function setInvoiceScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $invoiceScheduler = null);

    /**
     * Get invoiceScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    public function getInvoiceScheduler();

    /**
     * Get ddisCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getDdisCountry();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
