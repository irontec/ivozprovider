<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface;

/**
* ExternalCallFilterInterface
*/
interface ExternalCallFilterInterface extends LoggableEntityInterface
{
    public const HOLIDAYTARGETTYPE_NUMBER = 'number';

    public const HOLIDAYTARGETTYPE_EXTENSION = 'extension';

    public const HOLIDAYTARGETTYPE_VOICEMAIL = 'voicemail';

    public const OUTOFSCHEDULETARGETTYPE_NUMBER = 'number';

    public const OUTOFSCHEDULETARGETTYPE_EXTENSION = 'extension';

    public const OUTOFSCHEDULETARGETTYPE_VOICEMAIL = 'voicemail';

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

    /**
     * Check if the given number matches External Filter black list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isBlackListed($origin);

    /**
     * Check if the given number matches External Filter white list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isWhitelisted($origin);

    /**
     * @return null | \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     */
    public function getHolidayDateForToday();

    public function getCalendarPeriodForToday();

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule();

    /**
     * Get the holiday numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getHolidayNumberValueE164();

    /**
     * Get the out of schedule numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getOutOfScheduleNumberValueE164();

    /**
     * Get Target destination for Holidays
     *
     * @return null|string
     */
    public function getHolidayTarget(): ?string;

    /**
     * Alias for getHolidayTargetType
     *
     * @todo rename holidayTagetType field to holidayRouteType
     */
    public function getHolidayRouteType(): ?string;

    /**
     * Get Target destination for Out of schedule
     *
     * @return null|string
     */
    public function getOutOfScheduleTarget(): ?string;

    /**
     * Alias for getOutOfScheduleTargetType
     *
     * @todo rename outOfScheduleTargetType field to outOfScheduleRouteType
     */
    public function getOutOfScheduleRouteType(): ?string;

    public static function createDto(string|int|null $id = null): ExternalCallFilterDto;

    /**
     * @internal use EntityTools instead
     * @param null|ExternalCallFilterInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExternalCallFilterDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterDto;

    public function getName(): string;

    public function getHolidayEnabled(): bool;

    public function getHolidayTargetType(): ?string;

    public function getHolidayNumberValue(): ?string;

    public function getOutOfScheduleEnabled(): bool;

    public function getOutOfScheduleTargetType(): ?string;

    public function getOutOfScheduleNumberValue(): ?string;

    public function getCompany(): CompanyInterface;

    public function getWelcomeLocution(): ?LocutionInterface;

    public function getHolidayLocution(): ?LocutionInterface;

    public function getOutOfScheduleLocution(): ?LocutionInterface;

    public function getHolidayExtension(): ?ExtensionInterface;

    public function getOutOfScheduleExtension(): ?ExtensionInterface;

    public function getHolidayVoicemail(): ?VoicemailInterface;

    public function getOutOfScheduleVoicemail(): ?VoicemailInterface;

    public function getHolidayNumberCountry(): ?CountryInterface;

    public function getOutOfScheduleNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface;

    public function removeCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface;

    /**
     * @param Collection<array-key, ExternalCallFilterRelCalendarInterface> $calendars
     */
    public function replaceCalendars(Collection $calendars): ExternalCallFilterInterface;

    public function getCalendars(?Criteria $criteria = null): array;

    public function addBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface;

    public function removeBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface;

    /**
     * @param Collection<array-key, ExternalCallFilterBlackListInterface> $blackLists
     */
    public function replaceBlackLists(Collection $blackLists): ExternalCallFilterInterface;

    public function getBlackLists(?Criteria $criteria = null): array;

    public function addWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface;

    public function removeWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface;

    /**
     * @param Collection<array-key, ExternalCallFilterWhiteListInterface> $whiteLists
     */
    public function replaceWhiteLists(Collection $whiteLists): ExternalCallFilterInterface;

    public function getWhiteLists(?Criteria $criteria = null): array;

    public function addSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface;

    public function removeSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface;

    /**
     * @param Collection<array-key, ExternalCallFilterRelScheduleInterface> $schedules
     */
    public function replaceSchedules(Collection $schedules): ExternalCallFilterInterface;

    public function getSchedules(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
