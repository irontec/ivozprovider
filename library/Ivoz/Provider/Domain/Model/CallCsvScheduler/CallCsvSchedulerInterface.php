<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CallCsvSchedulerInterface extends SchedulerInterface, LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

    /**
     * @return \DateInterval
     */
    public function getInterval();

    /**
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @deprecated
     * Set unit
     *
     * @param string $unit
     *
     * @return self
     */
    public function setUnit($unit);

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit();

    /**
     * @deprecated
     * Set frequency
     *
     * @param integer $frequency
     *
     * @return self
     */
    public function setFrequency($frequency);

    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency();

    /**
     * @deprecated
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * @deprecated
     * Set lastExecution
     *
     * @param \DateTime $lastExecution
     *
     * @return self
     */
    public function setLastExecution($lastExecution = null);

    /**
     * Get lastExecution
     *
     * @return \DateTime
     */
    public function getLastExecution();

    /**
     * @deprecated
     * Set lastExecutionError
     *
     * @param string $lastExecutionError
     *
     * @return self
     */
    public function setLastExecutionError($lastExecutionError = null);

    /**
     * Get lastExecutionError
     *
     * @return string
     */
    public function getLastExecutionError();

    /**
     * @deprecated
     * Set nextExecution
     *
     * @param \DateTime $nextExecution
     *
     * @return self
     */
    public function setNextExecution($nextExecution = null);

    /**
     * Get nextExecution
     *
     * @return \DateTime
     */
    public function getNextExecution();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

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
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();
}
