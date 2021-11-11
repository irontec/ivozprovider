<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Domain\Model\SchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
    public const UNIT_DAY = 'day';

    public const UNIT_WEEK = 'week';

    public const UNIT_MONTH = 'month';

    public const CALLDIRECTION_INBOUND = 'inbound';

    public const CALLDIRECTION_OUTBOUND = 'outbound';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function getTimezone(): ?TimezoneInterface;

    public function getSchedulerDateTimeZone(): \DateTimeZone;

    /**
     * @return \DateInterval
     */
    public function getInterval(): \DateInterval;

    /**
     * @internal use EntityTools instead
     * @return CallCsvSchedulerDto
     */
    public function toDto(int $depth = 0): CallCsvSchedulerDto;

    public static function createDto(string|int|null $id = null): CallCsvSchedulerDto;

    /**
     * @internal use EntityTools instead
     * @param null|CallCsvSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallCsvSchedulerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    public function getName(): string;

    public function getUnit(): string;

    public function getFrequency(): int;

    public function getCallDirection(): ?string;

    public function getEmail(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastExecution(): ?\DateTimeInterface;

    public function getLastExecutionError(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getNextExecution(): ?\DateTimeInterface;

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
