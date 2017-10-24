<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $priority = '1';

    /**
     * @var string
     */
    private $routeType;

    /**
     * @var string
     */
    private $numberValue;

    /**
     * @var string
     */
    private $friendValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $conditionalRouteId;

    /**
     * @var mixed
     */
    private $ivrCommonId;

    /**
     * @var mixed
     */
    private $ivrCustomId;

    /**
     * @var mixed
     */
    private $huntGroupId;

    /**
     * @var mixed
     */
    private $voicemailUserId;

    /**
     * @var mixed
     */
    private $userId;

    /**
     * @var mixed
     */
    private $queueId;

    /**
     * @var mixed
     */
    private $locutionId;

    /**
     * @var mixed
     */
    private $conferenceRoomId;

    /**
     * @var mixed
     */
    private $extensionId;

    /**
     * @var mixed
     */
    private $conditionalRoute;

    /**
     * @var mixed
     */
    private $ivrCommon;

    /**
     * @var mixed
     */
    private $ivrCustom;

    /**
     * @var mixed
     */
    private $huntGroup;

    /**
     * @var mixed
     */
    private $voicemailUser;

    /**
     * @var mixed
     */
    private $user;

    /**
     * @var mixed
     */
    private $queue;

    /**
     * @var mixed
     */
    private $locution;

    /**
     * @var mixed
     */
    private $conferenceRoom;

    /**
     * @var mixed
     */
    private $extension;

    /**
     * @var array|null
     */
    private $matchlists = null;

    /**
     * @var array|null
     */
    private $schedules = null;

    /**
     * @var array|null
     */
    private $calendars = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'priority' => $this->getPriority(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'conditionalRouteId' => $this->getConditionalRouteId(),
            'ivrCommonId' => $this->getIvrCommonId(),
            'ivrCustomId' => $this->getIvrCustomId(),
            'huntGroupId' => $this->getHuntGroupId(),
            'voicemailUserId' => $this->getVoicemailUserId(),
            'userId' => $this->getUserId(),
            'queueId' => $this->getQueueId(),
            'locutionId' => $this->getLocutionId(),
            'conferenceRoomId' => $this->getConferenceRoomId(),
            'extensionId' => $this->getExtensionId(),
            'matchlistsId' => $this->getMatchlistsId(),
            'schedulesId' => $this->getSchedulesId(),
            'calendarsId' => $this->getCalendarsId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->conditionalRoute = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ConditionalRoute\\ConditionalRoute', $this->getConditionalRouteId());
        $this->ivrCommon = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\IvrCommon\\IvrCommon', $this->getIvrCommonId());
        $this->ivrCustom = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\IvrCustom\\IvrCustom', $this->getIvrCustomId());
        $this->huntGroup = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\HuntGroup\\HuntGroup', $this->getHuntGroupId());
        $this->voicemailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getVoicemailUserId());
        $this->user = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getUserId());
        $this->queue = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Queue\\Queue', $this->getQueueId());
        $this->locution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getLocutionId());
        $this->conferenceRoom = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ConferenceRoom\\ConferenceRoom', $this->getConferenceRoomId());
        $this->extension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getExtensionId());
        if (!is_null($this->matchlists)) {
            $items = $this->getMatchlists();
            $this->matchlists = [];
            foreach ($items as $item) {
                $this->matchlists[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelMatchlist\\ConditionalRoutesConditionsRelMatchlist',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->schedules)) {
            $items = $this->getSchedules();
            $this->schedules = [];
            foreach ($items as $item) {
                $this->schedules[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelSchedule\\ConditionalRoutesConditionsRelSchedule',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->calendars)) {
            $items = $this->getCalendars();
            $this->calendars = [];
            foreach ($items as $item) {
                $this->calendars[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelCalendar\\ConditionalRoutesConditionsRelCalendar',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->matchlists = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelMatchlist\\ConditionalRoutesConditionsRelMatchlist',
            $this->matchlists
        );
        $this->schedules = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelSchedule\\ConditionalRoutesConditionsRelSchedule',
            $this->schedules
        );
        $this->calendars = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelCalendar\\ConditionalRoutesConditionsRelCalendar',
            $this->calendars
        );
    }

    /**
     * @param integer $priority
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $routeType
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setRouteType($routeType = null)
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * @param string $numberValue
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setNumberValue($numberValue = null)
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * @param string $friendValue
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setFriendValue($friendValue = null)
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getFriendValue()
    {
        return $this->friendValue;
    }

    /**
     * @param integer $id
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $conditionalRouteId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setConditionalRouteId($conditionalRouteId)
    {
        $this->conditionalRouteId = $conditionalRouteId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConditionalRouteId()
    {
        return $this->conditionalRouteId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }

    /**
     * @param integer $ivrCommonId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setIvrCommonId($ivrCommonId)
    {
        $this->ivrCommonId = $ivrCommonId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIvrCommonId()
    {
        return $this->ivrCommonId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommon
     */
    public function getIvrCommon()
    {
        return $this->ivrCommon;
    }

    /**
     * @param integer $ivrCustomId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setIvrCustomId($ivrCustomId)
    {
        $this->ivrCustomId = $ivrCustomId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getIvrCustomId()
    {
        return $this->ivrCustomId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustom
     */
    public function getIvrCustom()
    {
        return $this->ivrCustom;
    }

    /**
     * @param integer $huntGroupId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setHuntGroupId($huntGroupId)
    {
        $this->huntGroupId = $huntGroupId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHuntGroupId()
    {
        return $this->huntGroupId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * @param integer $voicemailUserId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setVoicemailUserId($voicemailUserId)
    {
        $this->voicemailUserId = $voicemailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVoicemailUserId()
    {
        return $this->voicemailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getVoicemailUser()
    {
        return $this->voicemailUser;
    }

    /**
     * @param integer $userId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $queueId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setQueueId($queueId)
    {
        $this->queueId = $queueId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Queue\Queue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param integer $locutionId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setLocutionId($locutionId)
    {
        $this->locutionId = $locutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLocutionId()
    {
        return $this->locutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getLocution()
    {
        return $this->locution;
    }

    /**
     * @param integer $conferenceRoomId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setConferenceRoomId($conferenceRoomId)
    {
        $this->conferenceRoomId = $conferenceRoomId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConferenceRoomId()
    {
        return $this->conferenceRoomId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * @param integer $extensionId
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setExtensionId($extensionId)
    {
        $this->extensionId = $extensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExtensionId()
    {
        return $this->extensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param array $matchlists
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setMatchlists($matchlists)
    {
        $this->matchlists = $matchlists;

        return $this;
    }

    /**
     * @return array
     */
    public function getMatchlists()
    {
        return $this->matchlists;
    }

    /**
     * @param array $schedules
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;

        return $this;
    }

    /**
     * @return array
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * @param array $calendars
     *
     * @return ConditionalRoutesConditionDTO
     */
    public function setCalendars($calendars)
    {
        $this->calendars = $calendars;

        return $this;
    }

    /**
     * @return array
     */
    public function getCalendars()
    {
        return $this->calendars;
    }
}


