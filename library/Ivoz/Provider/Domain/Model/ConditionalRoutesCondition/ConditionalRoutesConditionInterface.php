<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;

/**
* ConditionalRoutesConditionInterface
*/
interface ConditionalRoutesConditionInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_USER = 'user';

    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_IVR = 'ivr';

    public const ROUTETYPE_HUNTGROUP = 'huntGroup';

    public const ROUTETYPE_VOICEMAIL = 'voicemail';

    public const ROUTETYPE_FRIEND = 'friend';

    public const ROUTETYPE_QUEUE = 'queue';

    public const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';

    public const ROUTETYPE_EXTENSION = 'extension';

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
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Return MatchLists associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
     */
    public function getMatchLists();

    /**
     * Return Schedules associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface[]
     */
    public function getSchedules();

    /**
     * Return Calendars associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface[]
     */
    public function getCalendars();

    /**
     * Return Route Locks associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface[]
     */
    public function getRouteLocks();

    /**
     * Checks if this condition mathes the given origin
     *
     * @param string $number in E.164 format
     * @return bool true if condition matches
     */
    public function matchesOrigin($number);

    /**
     * Checks if current time in Company's timezone matches condition schedules
     *
     * @return bool true if condition matches
     */
    public function matchesSchedule();

    /**
     * Checks if today is holiday in condition calendars
     *
     * @return bool true if condition matches
     */
    public function matchesCalendar();

    /**
     * Checks if any of the Locks is open
     *
     * @return bool true if condition matches
     */
    public function matchesRouteLock();

    /**
     * Return a string representation of matching conditions
     *
     * @return string
     */
    public function getMatchData(): string;

    public static function createDto(string|int|null $id = null): ConditionalRoutesConditionDto;

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRoutesConditionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRoutesConditionDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRoutesConditionDto;

    public function getPriority(): int;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function getFriendValue(): ?string;

    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute): static;

    public function getConditionalRoute(): ConditionalRouteInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getVoicemail(): ?VoicemailInterface;

    public function getUser(): ?UserInterface;

    public function getQueue(): ?QueueInterface;

    public function getLocution(): ?LocutionInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    public function removeRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelMatchlistInterface> $relMatchlists
     */
    public function replaceRelMatchlists(Collection $relMatchlists): ConditionalRoutesConditionInterface;

    public function getRelMatchlists(?Criteria $criteria = null): array;

    public function addRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    public function removeRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelScheduleInterface> $relSchedules
     */
    public function replaceRelSchedules(Collection $relSchedules): ConditionalRoutesConditionInterface;

    public function getRelSchedules(?Criteria $criteria = null): array;

    public function addRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    public function removeRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelCalendarInterface> $relCalendars
     */
    public function replaceRelCalendars(Collection $relCalendars): ConditionalRoutesConditionInterface;

    public function getRelCalendars(?Criteria $criteria = null): array;

    public function addRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    public function removeRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    /**
     * @param Collection<array-key, ConditionalRoutesConditionsRelRouteLockInterface> $relRouteLocks
     */
    public function replaceRelRouteLocks(Collection $relRouteLocks): ConditionalRoutesConditionInterface;

    public function getRelRouteLocks(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
