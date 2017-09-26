<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ConditionalRouteAbstract
 * @codeCoverageIgnore
 */
abstract class ConditionalRouteAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @comment enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension
     * @var string
     */
    protected $routetype;

    /**
     * @var string
     */
    protected $numbervalue;

    /**
     * @var string
     */
    protected $friendvalue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface
     */
    protected $ivrCommon;

    /**
     * @var \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface
     */
    protected $ivrCustom;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    protected $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $voicemailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $locution;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $extension;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
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
     * @return ConditionalRouteDTO
     */
    public static function createDTO()
    {
        return new ConditionalRouteDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRouteDTO
         */
        Assertion::isInstanceOf($dto, ConditionalRouteDTO::class);

        $self = new static(
            $dto->getName());

        return $self
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($dto->getCompany())
            ->setIvrCommon($dto->getIvrCommon())
            ->setIvrCustom($dto->getIvrCustom())
            ->setHuntGroup($dto->getHuntGroup())
            ->setVoicemailUser($dto->getVoicemailUser())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setLocution($dto->getLocution())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setExtension($dto->getExtension())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRouteDTO
         */
        Assertion::isInstanceOf($dto, ConditionalRouteDTO::class);

        $this
            ->setName($dto->getName())
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($dto->getCompany())
            ->setIvrCommon($dto->getIvrCommon())
            ->setIvrCustom($dto->getIvrCustom())
            ->setHuntGroup($dto->getHuntGroup())
            ->setVoicemailUser($dto->getVoicemailUser())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setLocution($dto->getLocution())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setExtension($dto->getExtension());


        return $this;
    }

    /**
     * @return ConditionalRouteDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setRoutetype($this->getRoutetype())
            ->setNumbervalue($this->getNumbervalue())
            ->setFriendvalue($this->getFriendvalue())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setIvrCommonId($this->getIvrCommon() ? $this->getIvrCommon()->getId() : null)
            ->setIvrCustomId($this->getIvrCustom() ? $this->getIvrCustom()->getId() : null)
            ->setHuntGroupId($this->getHuntGroup() ? $this->getHuntGroup()->getId() : null)
            ->setVoicemailUserId($this->getVoicemailUser() ? $this->getVoicemailUser()->getId() : null)
            ->setUserId($this->getUser() ? $this->getUser()->getId() : null)
            ->setQueueId($this->getQueue() ? $this->getQueue()->getId() : null)
            ->setLocutionId($this->getLocution() ? $this->getLocution()->getId() : null)
            ->setConferenceRoomId($this->getConferenceRoom() ? $this->getConferenceRoom()->getId() : null)
            ->setExtensionId($this->getExtension() ? $this->getExtension()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => $this->getName(),
            'routetype' => $this->getRoutetype(),
            'numbervalue' => $this->getNumbervalue(),
            'friendvalue' => $this->getFriendvalue(),
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null,
            'ivrCommonId' => $this->getIvrCommon() ? $this->getIvrCommon()->getId() : null,
            'ivrCustomId' => $this->getIvrCustom() ? $this->getIvrCustom()->getId() : null,
            'huntGroupId' => $this->getHuntGroup() ? $this->getHuntGroup()->getId() : null,
            'voicemailUserId' => $this->getVoicemailUser() ? $this->getVoicemailUser()->getId() : null,
            'userId' => $this->getUser() ? $this->getUser()->getId() : null,
            'queueId' => $this->getQueue() ? $this->getQueue()->getId() : null,
            'locutionId' => $this->getLocution() ? $this->getLocution()->getId() : null,
            'conferenceRoomId' => $this->getConferenceRoom() ? $this->getConferenceRoom()->getId() : null,
            'extensionId' => $this->getExtension() ? $this->getExtension()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 100);

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set routetype
     *
     * @param string $routetype
     *
     * @return self
     */
    public function setRoutetype($routetype = null)
    {
        if (!is_null($routetype)) {
            Assertion::maxLength($routetype, 25);
        Assertion::choice($routetype, array (
          0 => 'user',
          1 => 'number',
          2 => 'IVRCommon',
          3 => 'IVRCustom',
          4 => 'huntGroup',
          5 => 'voicemail',
          6 => 'friend',
          7 => 'queue',
          8 => 'conferenceRoom',
          9 => 'extension',
        ));
        }

        $this->routetype = $routetype;

        return $this;
    }

    /**
     * Get routetype
     *
     * @return string
     */
    public function getRoutetype()
    {
        return $this->routetype;
    }

    /**
     * Set numbervalue
     *
     * @param string $numbervalue
     *
     * @return self
     */
    public function setNumbervalue($numbervalue = null)
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25);
        }

        $this->numbervalue = $numbervalue;

        return $this;
    }

    /**
     * Get numbervalue
     *
     * @return string
     */
    public function getNumbervalue()
    {
        return $this->numbervalue;
    }

    /**
     * Set friendvalue
     *
     * @param string $friendvalue
     *
     * @return self
     */
    public function setFriendvalue($friendvalue = null)
    {
        if (!is_null($friendvalue)) {
            Assertion::maxLength($friendvalue, 25);
        }

        $this->friendvalue = $friendvalue;

        return $this;
    }

    /**
     * Get friendvalue
     *
     * @return string
     */
    public function getFriendvalue()
    {
        return $this->friendvalue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
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
        $this->ivrCommon = $ivrCommon;

        return $this;
    }

    /**
     * Get ivrCommon
     *
     * @return \Ivoz\Provider\Domain\Model\IvrCommon\IvrCommonInterface
     */
    public function getIvrCommon()
    {
        return $this->ivrCommon;
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
        $this->ivrCustom = $ivrCustom;

        return $this;
    }

    /**
     * Get ivrCustom
     *
     * @return \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface
     */
    public function getIvrCustom()
    {
        return $this->ivrCustom;
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
     * Set voicemailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser
     *
     * @return self
     */
    public function setVoicemailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser = null)
    {
        $this->voicemailUser = $voicemailUser;

        return $this;
    }

    /**
     * Get voicemailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getVoicemailUser()
    {
        return $this->voicemailUser;
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
     * Set locution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution
     *
     * @return self
     */
    public function setLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution = null)
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getLocution()
    {
        return $this->locution;
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
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return self
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }



    // @codeCoverageIgnoreEnd
}

