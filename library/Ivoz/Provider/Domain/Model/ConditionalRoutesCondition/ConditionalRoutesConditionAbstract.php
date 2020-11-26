<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* ConditionalRoutesConditionAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     */
    protected $priority = 1;

    /**
     * comment: enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension
     * @var string | null
     */
    protected $routeType;

    /**
     * @var string | null
     */
    protected $numberValue;

    /**
     * @var string | null
     */
    protected $friendValue;

    /**
     * @var ConditionalRouteInterface
     * inversedBy conditions
     */
    protected $conditionalRoute;

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
        $priority
    ) {
        $this->setPriority($priority);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesCondition",
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
     * @return ConditionalRoutesConditionDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRoutesConditionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionInterface|null $entity
     * @param int $depth
     * @return ConditionalRoutesConditionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRoutesConditionInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ConditionalRoutesConditionDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionDto::class);

        $self = new static(
            $dto->getPriority()
        );

        $self
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
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
     * @param ConditionalRoutesConditionDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionDto::class);

        $this
            ->setPriority($dto->getPriority())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
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
     * @return ConditionalRoutesConditionDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPriority(self::getPriority())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setFriendValue(self::getFriendValue())
            ->setConditionalRoute(ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
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
            'priority' => self::getPriority(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'friendValue' => self::getFriendValue(),
            'conditionalRouteId' => self::getConditionalRoute()->getId(),
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
     * Set priority
     *
     * @param int $priority
     *
     * @return static
     */
    protected function setPriority(int $priority): ConditionalRoutesConditionInterface
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set routeType
     *
     * @param string $routeType | null
     *
     * @return static
     */
    protected function setRouteType(?string $routeType = null): ConditionalRoutesConditionInterface
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routeType,
                [
                    ConditionalRoutesConditionInterface::ROUTETYPE_USER,
                    ConditionalRoutesConditionInterface::ROUTETYPE_NUMBER,
                    ConditionalRoutesConditionInterface::ROUTETYPE_IVR,
                    ConditionalRoutesConditionInterface::ROUTETYPE_HUNTGROUP,
                    ConditionalRoutesConditionInterface::ROUTETYPE_VOICEMAIL,
                    ConditionalRoutesConditionInterface::ROUTETYPE_FRIEND,
                    ConditionalRoutesConditionInterface::ROUTETYPE_QUEUE,
                    ConditionalRoutesConditionInterface::ROUTETYPE_CONFERENCEROOM,
                    ConditionalRoutesConditionInterface::ROUTETYPE_EXTENSION,
                ],
                'routeTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue | null
     *
     * @return static
     */
    protected function setNumberValue(?string $numberValue = null): ConditionalRoutesConditionInterface
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    /**
     * Set friendValue
     *
     * @param string $friendValue | null
     *
     * @return static
     */
    protected function setFriendValue(?string $friendValue = null): ConditionalRoutesConditionInterface
    {
        if (!is_null($friendValue)) {
            Assertion::maxLength($friendValue, 25, 'friendValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * Get friendValue
     *
     * @return string | null
     */
    public function getFriendValue(): ?string
    {
        return $this->friendValue;
    }

    /**
     * Set conditionalRoute
     *
     * @param ConditionalRouteInterface
     *
     * @return static
     */
    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute): ConditionalRoutesConditionInterface
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface
     */
    public function getConditionalRoute(): ConditionalRouteInterface
    {
        return $this->conditionalRoute;
    }

    /**
     * Set ivr
     *
     * @param IvrInterface | null
     *
     * @return static
     */
    protected function setIvr(?IvrInterface $ivr = null): ConditionalRoutesConditionInterface
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
    protected function setHuntGroup(?HuntGroupInterface $huntGroup = null): ConditionalRoutesConditionInterface
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
    protected function setVoicemailUser(?UserInterface $voicemailUser = null): ConditionalRoutesConditionInterface
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
    protected function setUser(?UserInterface $user = null): ConditionalRoutesConditionInterface
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
    protected function setQueue(?QueueInterface $queue = null): ConditionalRoutesConditionInterface
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
    protected function setLocution(?LocutionInterface $locution = null): ConditionalRoutesConditionInterface
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
    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): ConditionalRoutesConditionInterface
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
    protected function setExtension(?ExtensionInterface $extension = null): ConditionalRoutesConditionInterface
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
    protected function setNumberCountry(?CountryInterface $numberCountry = null): ConditionalRoutesConditionInterface
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
