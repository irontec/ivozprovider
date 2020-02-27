<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CallCsvSchedulerInterface extends SchedulerInterface, LoggableEntityInterface
{
    const UNIT_DAY = 'day';
    const UNIT_WEEK = 'week';
    const UNIT_MONTH = 'month';


    const CALLDIRECTION_INBOUND = 'inbound';
    const CALLDIRECTION_OUTBOUND = 'outbound';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

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
     * Get callDirection
     *
     * @return string | null
     */
    public function getCallDirection();

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
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get callCsvNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate();

    /**
     * Get ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi();

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount();

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice();
}
