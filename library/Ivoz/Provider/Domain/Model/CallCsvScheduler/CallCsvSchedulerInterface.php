<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
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

/**
* CallCsvSchedulerInterface
*/
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

    public function getSchedulerDateTimeZone(): \DateTimeZone;

    /**
     * @return \DateInterval
     */
    public function getInterval();

    public function getName(): string;

    public function getUnit(): string;

    public function getFrequency(): int;

    public function getCallDirection(): ?string;

    public function getEmail(): string;

    public function getLastExecution(): ?\DateTime;

    public function getLastExecutionError(): ?string;

    public function getNextExecution(): ?\DateTime;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface;

    public function getDdi(): ?DdiInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getUser(): ?UserInterface;

    public function getFax(): ?FaxInterface;

    public function getFriend(): ?FriendInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    public function isInitialized(): bool;
}
