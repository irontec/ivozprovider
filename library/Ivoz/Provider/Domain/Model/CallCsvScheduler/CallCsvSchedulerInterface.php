<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CallCsvSchedulerInterface
*/
interface CallCsvSchedulerInterface extends LoggableEntityInterface
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
     * Get callDirection
     *
     * @return string | null
     */
    public function getCallDirection(): ?string;

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
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Get callCsvNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface;

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface;

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
