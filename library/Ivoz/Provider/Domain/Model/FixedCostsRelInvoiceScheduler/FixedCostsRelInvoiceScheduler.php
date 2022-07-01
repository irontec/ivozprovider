<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

/**
 * FixedCostsRelInvoiceScheduler
 */
class FixedCostsRelInvoiceScheduler extends FixedCostsRelInvoiceSchedulerAbstract implements FixedCostsRelInvoiceSchedulerInterface
{
    use FixedCostsRelInvoiceSchedulerTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        if ($this->getType() !== self::TYPE_STATIC) {
            $this->setQuantity(null);
        }
        if ($this->getType() !== self::TYPE_DDIS) {
            $this->setCountry(null);
        }
    }
}
