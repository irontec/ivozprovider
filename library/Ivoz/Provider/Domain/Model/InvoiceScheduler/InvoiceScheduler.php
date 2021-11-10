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
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setEmail(string $email): static
    {
        if (!empty($email)) {
            Assertion::email($email);
        }
        return parent::setEmail($email);
    }

    /**
     * @inheritdoc
     */
    public function setFrequency(int $frequency): static
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
    public function getInterval(): \DateInterval
    {
        $frecuency = $this->getFrequency();

        switch ($this->getUnit()) {
            /** @see http://php.net/manual/es/dateinterval.createfromdatestring.php */
            case InvoiceSchedulerInterface::UNIT_YEAR:
                return new \DateInterval("P${frecuency}Y");
            case InvoiceSchedulerInterface::UNIT_MONTH:
                return new \DateInterval("P${frecuency}M");
            default:
                return new \DateInterval("P${frecuency}W");
        }
    }

    protected function setLastExecutionError(?string $lastExecutionError = null): static
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
