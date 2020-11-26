<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockDto;

/**
* ConditionalRoutesConditionDtoAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $priority = 1;

    /**
     * @var string | null
     */
    private $routeType;

    /**
     * @var string | null
     */
    private $numberValue;

    /**
     * @var string | null
     */
    private $friendValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute;

    /**
     * @var IvrDto | null
     */
    private $ivr;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup;

    /**
     * @var UserDto | null
     */
    private $voicemailUser;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var QueueDto | null
     */
    private $queue;

    /**
     * @var LocutionDto | null
     */
    private $locution;

    /**
     * @var ConferenceRoomDto | null
     */
    private $conferenceRoom;

    /**
     * @var ExtensionDto | null
     */
    private $extension;

    /**
     * @var CountryDto | null
     */
    private $numberCountry;

    /**
     * @var ConditionalRoutesConditionsRelMatchlistDto[] | null
     */
    private $relMatchlists;

    /**
     * @var ConditionalRoutesConditionsRelScheduleDto[] | null
     */
    private $relSchedules;

    /**
     * @var ConditionalRoutesConditionsRelCalendarDto[] | null
     */
    private $relCalendars;

    /**
     * @var ConditionalRoutesConditionsRelRouteLockDto[] | null
     */
    private $relRouteLocks;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'priority' => 'priority',
            'routeType' => 'routeType',
            'numberValue' => 'numberValue',
            'friendValue' => 'friendValue',
            'id' => 'id',
            'conditionalRouteId' => 'conditionalRoute',
            'ivrId' => 'ivr',
            'huntGroupId' => 'huntGroup',
            'voicemailUserId' => 'voicemailUser',
            'userId' => 'user',
            'queueId' => 'queue',
            'locutionId' => 'locution',
            'conferenceRoomId' => 'conferenceRoom',
            'extensionId' => 'extension',
            'numberCountryId' => 'numberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'priority' => $this->getPriority(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'conditionalRoute' => $this->getConditionalRoute(),
            'ivr' => $this->getIvr(),
            'huntGroup' => $this->getHuntGroup(),
            'voicemailUser' => $this->getVoicemailUser(),
            'user' => $this->getUser(),
            'queue' => $this->getQueue(),
            'locution' => $this->getLocution(),
            'conferenceRoom' => $this->getConferenceRoom(),
            'extension' => $this->getExtension(),
            'numberCountry' => $this->getNumberCountry(),
            'relMatchlists' => $this->getRelMatchlists(),
            'relSchedules' => $this->getRelSchedules(),
            'relCalendars' => $this->getRelCalendars(),
            'relRouteLocks' => $this->getRelRouteLocks()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param string $routeType | null
     *
     * @return static
     */
    public function setRouteType(?string $routeType = null): self
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    /**
     * @param string $numberValue | null
     *
     * @return static
     */
    public function setNumberValue(?string $numberValue = null): self
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    /**
     * @param string $friendValue | null
     *
     * @return static
     */
    public function setFriendValue(?string $friendValue = null): self
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFriendValue(): ?string
    {
        return $this->friendValue;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param ConditionalRouteDto | null
     *
     * @return static
     */
    public function setConditionalRoute(?ConditionalRouteDto $conditionalRoute = null): self
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * @return ConditionalRouteDto | null
     */
    public function getConditionalRoute(): ?ConditionalRouteDto
    {
        return $this->conditionalRoute;
    }

    /**
     * @return static
     */
    public function setConditionalRouteId($id): self
    {
        $value = !is_null($id)
            ? new ConditionalRouteDto($id)
            : null;

        return $this->setConditionalRoute($value);
    }

    /**
     * @return mixed | null
     */
    public function getConditionalRouteId()
    {
        if ($dto = $this->getConditionalRoute()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param IvrDto | null
     *
     * @return static
     */
    public function setIvr(?IvrDto $ivr = null): self
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * @return IvrDto | null
     */
    public function getIvr(): ?IvrDto
    {
        return $this->ivr;
    }

    /**
     * @return static
     */
    public function setIvrId($id): self
    {
        $value = !is_null($id)
            ? new IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    /**
     * @return mixed | null
     */
    public function getIvrId()
    {
        if ($dto = $this->getIvr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param HuntGroupDto | null
     *
     * @return static
     */
    public function setHuntGroup(?HuntGroupDto $huntGroup = null): self
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * @return HuntGroupDto | null
     */
    public function getHuntGroup(): ?HuntGroupDto
    {
        return $this->huntGroup;
    }

    /**
     * @return static
     */
    public function setHuntGroupId($id): self
    {
        $value = !is_null($id)
            ? new HuntGroupDto($id)
            : null;

        return $this->setHuntGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getHuntGroupId()
    {
        if ($dto = $this->getHuntGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setVoicemailUser(?UserDto $voicemailUser = null): self
    {
        $this->voicemailUser = $voicemailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getVoicemailUser(): ?UserDto
    {
        return $this->voicemailUser;
    }

    /**
     * @return static
     */
    public function setVoicemailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setVoicemailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getVoicemailUserId()
    {
        if ($dto = $this->getVoicemailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setUser(?UserDto $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    /**
     * @return static
     */
    public function setUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param QueueDto | null
     *
     * @return static
     */
    public function setQueue(?QueueDto $queue = null): self
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return QueueDto | null
     */
    public function getQueue(): ?QueueDto
    {
        return $this->queue;
    }

    /**
     * @return static
     */
    public function setQueueId($id): self
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    /**
     * @return mixed | null
     */
    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setLocution(?LocutionDto $locution = null): self
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getLocution(): ?LocutionDto
    {
        return $this->locution;
    }

    /**
     * @return static
     */
    public function setLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getLocutionId()
    {
        if ($dto = $this->getLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ConferenceRoomDto | null
     *
     * @return static
     */
    public function setConferenceRoom(?ConferenceRoomDto $conferenceRoom = null): self
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * @return ConferenceRoomDto | null
     */
    public function getConferenceRoom(): ?ConferenceRoomDto
    {
        return $this->conferenceRoom;
    }

    /**
     * @return static
     */
    public function setConferenceRoomId($id): self
    {
        $value = !is_null($id)
            ? new ConferenceRoomDto($id)
            : null;

        return $this->setConferenceRoom($value);
    }

    /**
     * @return mixed | null
     */
    public function getConferenceRoomId()
    {
        if ($dto = $this->getConferenceRoom()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setExtension(?ExtensionDto $extension = null): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    /**
     * @return static
     */
    public function setExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNumberCountry(?CountryDto $numberCountry = null): self
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    /**
     * @return static
     */
    public function setNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ConditionalRoutesConditionsRelMatchlistDto[] | null
     *
     * @return static
     */
    public function setRelMatchlists(?array $relMatchlists = null): self
    {
        $this->relMatchlists = $relMatchlists;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelMatchlistDto[] | null
     */
    public function getRelMatchlists(): ?array
    {
        return $this->relMatchlists;
    }

    /**
     * @param ConditionalRoutesConditionsRelScheduleDto[] | null
     *
     * @return static
     */
    public function setRelSchedules(?array $relSchedules = null): self
    {
        $this->relSchedules = $relSchedules;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelScheduleDto[] | null
     */
    public function getRelSchedules(): ?array
    {
        return $this->relSchedules;
    }

    /**
     * @param ConditionalRoutesConditionsRelCalendarDto[] | null
     *
     * @return static
     */
    public function setRelCalendars(?array $relCalendars = null): self
    {
        $this->relCalendars = $relCalendars;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelCalendarDto[] | null
     */
    public function getRelCalendars(): ?array
    {
        return $this->relCalendars;
    }

    /**
     * @param ConditionalRoutesConditionsRelRouteLockDto[] | null
     *
     * @return static
     */
    public function setRelRouteLocks(?array $relRouteLocks = null): self
    {
        $this->relRouteLocks = $relRouteLocks;

        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelRouteLockDto[] | null
     */
    public function getRelRouteLocks(): ?array
    {
        return $this->relRouteLocks;
    }

}
