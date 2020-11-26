<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* ConditionalRouteAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRouteAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * column: routeType
     * comment: enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension
     * @var string | null
     */
    protected $routetype;

    /**
     * column: numberValue
     * @var string | null
     */
    protected $numbervalue;

    /**
     * column: friendValue
     * @var string | null
     */
    protected $friendvalue;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var IvrInterface
     */
    protected $ivr;

    /**
     * @var HuntGroupInterface
     */
    protected $huntGroup;

    /**
     * @var UserInterface
     */
    protected $voicemailUser;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * @var LocutionInterface
     */
    protected $locution;

    /**
     * @var ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * @var CountryInterface
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $name
    ) {
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
     * @param ConditionalRouteInterface|null $entity
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

        /** @var ConditionalRouteDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRouteDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setVoicemailUser($fkTransformer->transform($dto->getVoicemailUser()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRouteDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);

        $this
            ->setName($dto->getName())
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setVoicemailUser($fkTransformer->transform($dto->getVoicemailUser()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

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
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setVoicemailUser(User::entityToDto(self::getVoicemailUser(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth))
            ->setLocution(Locution::entityToDto(self::getLocution(), $depth))
            ->setConferenceRoom(ConferenceRoom::entityToDto(self::getConferenceRoom(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
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
            'companyId' => self::getCompany()->getId(),
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): ConditionalRouteInterface
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set routetype
     *
     * @param string $routetype | null
     *
     * @return static
     */
    protected function setRoutetype(?string $routetype = null): ConditionalRouteInterface
    {
        if (!is_null($routetype)) {
            Assertion::maxLength($routetype, 25, 'routetype value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routetype,
                [
                    ConditionalRouteInterface::ROUTETYPE_USER,
                    ConditionalRouteInterface::ROUTETYPE_NUMBER,
                    ConditionalRouteInterface::ROUTETYPE_IVR,
                    ConditionalRouteInterface::ROUTETYPE_HUNTGROUP,
                    ConditionalRouteInterface::ROUTETYPE_VOICEMAIL,
                    ConditionalRouteInterface::ROUTETYPE_FRIEND,
                    ConditionalRouteInterface::ROUTETYPE_QUEUE,
                    ConditionalRouteInterface::ROUTETYPE_CONFERENCEROOM,
                    ConditionalRouteInterface::ROUTETYPE_EXTENSION,
                ],
                'routetypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->routetype = $routetype;

        return $this;
    }

    /**
     * Get routetype
     *
     * @return string | null
     */
    public function getRoutetype(): ?string
    {
        return $this->routetype;
    }

    /**
     * Set numbervalue
     *
     * @param string $numbervalue | null
     *
     * @return static
     */
    protected function setNumbervalue(?string $numbervalue = null): ConditionalRouteInterface
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
     * @return string | null
     */
    public function getNumbervalue(): ?string
    {
        return $this->numbervalue;
    }

    /**
     * Set friendvalue
     *
     * @param string $friendvalue | null
     *
     * @return static
     */
    protected function setFriendvalue(?string $friendvalue = null): ConditionalRouteInterface
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
     * @return string | null
     */
    public function getFriendvalue(): ?string
    {
        return $this->friendvalue;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): ConditionalRouteInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set ivr
     *
     * @param IvrInterface | null
     *
     * @return static
     */
    protected function setIvr(?IvrInterface $ivr = null): ConditionalRouteInterface
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return IvrInterface | null
     */
    public function getIvr(): ?IvrInterface
    {
        return $this->ivr;
    }

    /**
     * Set huntGroup
     *
     * @param HuntGroupInterface | null
     *
     * @return static
     */
    protected function setHuntGroup(?HuntGroupInterface $huntGroup = null): ConditionalRouteInterface
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return HuntGroupInterface | null
     */
    public function getHuntGroup(): ?HuntGroupInterface
    {
        return $this->huntGroup;
    }

    /**
     * Set voicemailUser
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setVoicemailUser(?UserInterface $voicemailUser = null): ConditionalRouteInterface
    {
        $this->voicemailUser = $voicemailUser;

        return $this;
    }

    /**
     * Get voicemailUser
     *
     * @return UserInterface | null
     */
    public function getVoicemailUser(): ?UserInterface
    {
        return $this->voicemailUser;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): ConditionalRouteInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Set queue
     *
     * @param QueueInterface | null
     *
     * @return static
     */
    protected function setQueue(?QueueInterface $queue = null): ConditionalRouteInterface
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return QueueInterface | null
     */
    public function getQueue(): ?QueueInterface
    {
        return $this->queue;
    }

    /**
     * Set locution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setLocution(?LocutionInterface $locution = null): ConditionalRouteInterface
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * Get locution
     *
     * @return LocutionInterface | null
     */
    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
    }

    /**
     * Set conferenceRoom
     *
     * @param ConferenceRoomInterface | null
     *
     * @return static
     */
    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): ConditionalRouteInterface
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * Get conferenceRoom
     *
     * @return ConferenceRoomInterface | null
     */
    public function getConferenceRoom(): ?ConferenceRoomInterface
    {
        return $this->conferenceRoom;
    }

    /**
     * Set extension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    protected function setExtension(?ExtensionInterface $extension = null): ConditionalRouteInterface
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    /**
     * Set numberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNumberCountry(?CountryInterface $numberCountry = null): ConditionalRouteInterface
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }

}
