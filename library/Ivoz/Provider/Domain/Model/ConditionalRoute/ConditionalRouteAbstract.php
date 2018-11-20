<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * comment: enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension
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
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    protected $ivr;

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
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $numberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name)
    {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoute",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return ConditionalRouteDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRouteDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ConditionalRouteDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRouteInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRouteDto
         */
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($dto->getCompany())
            ->setIvr($dto->getIvr())
            ->setHuntGroup($dto->getHuntGroup())
            ->setVoicemailUser($dto->getVoicemailUser())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setLocution($dto->getLocution())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setExtension($dto->getExtension())
            ->setNumberCountry($dto->getNumberCountry())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRouteDto
         */
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);

        $this
            ->setName($dto->getName())
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($dto->getCompany())
            ->setIvr($dto->getIvr())
            ->setHuntGroup($dto->getHuntGroup())
            ->setVoicemailUser($dto->getVoicemailUser())
            ->setUser($dto->getUser())
            ->setQueue($dto->getQueue())
            ->setLocution($dto->getLocution())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setExtension($dto->getExtension())
            ->setNumberCountry($dto->getNumberCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRouteDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setRoutetype(self::getRoutetype())
            ->setNumbervalue(self::getNumbervalue())
            ->setFriendvalue(self::getFriendvalue())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setIvr(\Ivoz\Provider\Domain\Model\Ivr\Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setVoicemailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getVoicemailUser(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setQueue(\Ivoz\Provider\Domain\Model\Queue\Queue::entityToDto(self::getQueue(), $depth))
            ->setLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getLocution(), $depth))
            ->setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom::entityToDto(self::getConferenceRoom(), $depth))
            ->setExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getExtension(), $depth))
            ->setNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'routeType' => self::getRoutetype(),
            'numberValue' => self::getNumbervalue(),
            'friendValue' => self::getFriendvalue(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'voicemailUserId' => self::getVoicemailUser() ? self::getVoicemailUser()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null,
            'locutionId' => self::getLocution() ? self::getLocution()->getId() : null,
            'conferenceRoomId' => self::getConferenceRoom() ? self::getConferenceRoom()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
     * Set routetype
     *
     * @param string $routetype
     *
     * @return self
     */
    public function setRoutetype($routetype = null)
    {
        if (!is_null($routetype)) {
            Assertion::maxLength($routetype, 25, 'routetype value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($routetype, array (
              0 => 'user',
              1 => 'number',
              2 => 'ivr',
              3 => 'huntGroup',
              4 => 'voicemail',
              5 => 'friend',
              6 => 'queue',
              7 => 'conferenceRoom',
              8 => 'extension',
            ), 'routetypevalue "%s" is not an element of the valid values: %s');
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
     * @deprecated
     * Set numbervalue
     *
     * @param string $numbervalue
     *
     * @return self
     */
    public function setNumbervalue($numbervalue = null)
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25, 'numbervalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set friendvalue
     *
     * @param string $friendvalue
     *
     * @return self
     */
    public function setFriendvalue($friendvalue = null)
    {
        if (!is_null($friendvalue)) {
            Assertion::maxLength($friendvalue, 25, 'friendvalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr
     *
     * @return self
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    public function getIvr()
    {
        return $this->ivr;
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

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry
     *
     * @return self
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }

    // @codeCoverageIgnoreEnd
}
