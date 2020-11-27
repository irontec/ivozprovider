<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Model\SchedulerInterface;

/**
 * InvoiceScheduler
 */
class InvoiceScheduler extends InvoiceSchedulerAbstract implements SchedulerInterface, InvoiceSchedulerInterface
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
    public function setEmail(string $email): self
    {
        if (!empty($email)) {
            Assertion::email($email);
        }
        return parent::setEmail($email);
    }

    /**
     * @inheritdoc
     */
    public function setFrequency(int $frequency): self
    {
        Assertion::greaterOrEqualThan($frequency, 1);
        return parent::setFrequency($frequency);
    }

    public function getSchedulerDateTimeZone(): \DateTimeZone
    {
        $timezone = $this->getBrand()->getDefaultTimezone();

        return new \DateTimeZone(
            $timezone->getTz()
        );
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

    protected function setLastExecutionError(?string $lastExecutionError = null): self
    {
        if (!is_null($lastExecutionError)) {
            $lastExecutionError = substr(
                $lastExecutionError,
                0,
                300
            );
        }

        return parent::setLastExecutionError($lastExecutionError);
    }
}
