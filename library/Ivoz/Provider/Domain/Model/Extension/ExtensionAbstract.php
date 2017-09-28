<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ExtensionAbstract
 * @codeCoverageIgnore
 */
abstract class ExtensionAbstract
{
    /**
     * @var string
     */
    protected $number;

    /**
     * @comment enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional
     * @var string
     */
    protected $routeType;

    /**
     * @var string
     */
    protected $numberValue;

    /**
     * @var string
     */
    protected $friendValue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface
     */
    protected $IvrCommon;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface
     */
    protected $IvrCustom;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    protected $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    protected $conditionalRoute;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($number)
    {
        $this->setNumber($number);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return ExtensionDTO
     */
    public static function createDTO()
    {
        return new ExtensionDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExtensionDTO
         */
        Assertion::isInstanceOf($dto, ExtensionDTO::class);

        $self = new static(
            $dto->getNumber());

        return $self
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($dto->getCompany())
            ->setIvrCommon($dto->getIvrCommon())
            ->setIvrCustom($dto->getIvrCustom())
            ->setHuntGroup($dto->getHuntGroup())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setConditionalRoute($dto->getConditionalRoute())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExtensionDTO
         */
        Assertion::isInstanceOf($dto, ExtensionDTO::class);

        $this
            ->setNumber($dto->getNumber())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($dto->getCompany())
            ->setIvrCommon($dto->getIvrCommon())
            ->setIvrCustom($dto->getIvrCustom())
            ->setHuntGroup($dto->getHuntGroup())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setConditionalRoute($dto->getConditionalRoute());


        return $this;
    }

    /**
     * @return ExtensionDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setNumber($this->getNumber())
            ->setRouteType($this->getRouteType())
            ->setNumberValue($this->getNumberValue())
            ->setFriendValue($this->getFriendValue())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setIvrCommonId($this->getIvrCommon() ? $this->getIvrCommon()->getId() : null)
            ->setIvrCustomId($this->getIvrCustom() ? $this->getIvrCustom()->getId() : null)
            ->setHuntGroupId($this->getHuntGroup() ? $this->getHuntGroup()->getId() : null)
            ->setConferenceRoomId($this->getConferenceRoom() ? $this->getConferenceRoom()->getId() : null)
            ->setUserId($this->getUser() ? $this->getUser()->getId() : null)
            ->setQueueId($this->getQueue() ? $this->getQueue()->getId() : null)
            ->setConditionalRouteId($this->getConditionalRoute() ? $this->getConditionalRoute()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'number' => $this->getNumber(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'friendValue' => $this->getFriendValue(),
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null,
            'ivrCommonId' => $this->getIvrCommon() ? $this->getIvrCommon()->getId() : null,
            'ivrCustomId' => $this->getIvrCustom() ? $this->getIvrCustom()->getId() : null,
            'huntGroupId' => $this->getHuntGroup() ? $this->getHuntGroup()->getId() : null,
            'conferenceRoomId' => $this->getConferenceRoom() ? $this->getConferenceRoom()->getId() : null,
            'userId' => $this->getUser() ? $this->getUser()->getId() : null,
            'queueId' => $this->getQueue() ? $this->getQueue()->getId() : null,
            'conditionalRouteId' => $this->getConditionalRoute() ? $this->getConditionalRoute()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set number
     *
     * @param string $number
     *
     * @return self
     */
    public function setNumber($number)
    {
        Assertion::notNull($number);
        Assertion::maxLength($number, 10);

        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set routeType
     *
     * @param string $routeType
     *
     * @return self
     */
    public function setRouteType($routeType = null)
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25);
        Assertion::choice($routeType, array (
          0 => 'user',
          1 => 'number',
          2 => 'IVRCommon',
          3 => 'IVRCustom',
          4 => 'huntGroup',
          5 => 'conferenceRoom',
          6 => 'friend',
          7 => 'queue',
          8 => 'retailAccount',
          9 => 'conditional',
        ));
        }

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue
     *
     * @return self
     */
    public function setNumberValue($numberValue = null)
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25);
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return string
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * Set friendValue
     *
     * @param string $friendValue
     *
     * @return self
     */
    public function setFriendValue($friendValue = null)
    {
        if (!is_null($friendValue)) {
            Assertion::maxLength($friendValue, 25);
        }

        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * Get friendValue
     *
     * @return string
     */
    public function getFriendValue()
    {
        return $this->friendValue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set ivrCommon
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface $ivrCommon
     *
     * @return self
     */
    public function setIvrCommon(\Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface $ivrCommon = null)
    {
        $this->IvrCommon = $ivrCommon;

        return $this;
    }

    /**
     * Get ivrCommon
     *
     * @return \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface
     */
    public function getIvrCommon()
    {
        return $this->IvrCommon;
    }

    /**
     * Set ivrCustom
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface $ivrCustom
     *
     * @return self
     */
    public function setIvrCustom(\Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface $ivrCustom = null)
    {
        $this->IvrCustom = $ivrCustom;

        return $this;
    }

    /**
     * Get ivrCustom
     *
     * @return \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface
     */
    public function getIvrCustom()
    {
        return $this->IvrCustom;
    }

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup
     *
     * @return self
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * Set conferenceRoom
     *
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom
     *
     * @return self
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null)
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return self
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute
     *
     * @return self
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }



    // @codeCoverageIgnoreEnd
}

