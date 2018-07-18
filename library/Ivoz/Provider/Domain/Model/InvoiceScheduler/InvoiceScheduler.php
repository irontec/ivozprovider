<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * InvoiceScheduler
 */
class InvoiceScheduler extends InvoiceSchedulerAbstract implements InvoiceSchedulerInterface
{
    use InvoiceSchedulerTrait;

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

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        if (!empty($email)) {
            Assertion::email($email);
        }
        return parent::setEmail($email);
    }

    /**
     * @inheritdoc
     */
    public function setFrequency($frequency)
    {
        Assertion::greaterOrEqualThan($frequency, 1);
        return parent::setFrequency($frequency);
    }

    /**
     * @return \DateInterval
     */
    public function getInterval()
    {
        $frecuency = $this->getFrequency();

        switch ($this->getUnit()) {
            /** @see http://php.net/manual/es/dateinterval.createfromdatestring.php */
            case 'year':
                return new \DateInterval("P${frecuency}Y");
            case 'month':
                return new \DateInterval("P${frecuency}M");
            case 'week':
                return new \DateInterval("P${frecuency}W");
        }
    }
}

