<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $priority = 1;

    /**
     * comment: enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension
     */
    protected $routeType;

    protected $numberValue;

    protected $friendValue;

    /**
     * @var ConditionalRouteInterface
     * inversedBy conditions
     */
    protected $conditionalRoute;

    /**
     * @var IvrInterface | null
     */
    protected $ivr;

    /**
     * @var HuntGroupInterface | null
     */
    protected $huntGroup;

    /**
     * @var UserInterface | null
     */
    protected $voicemailUser;

    /**
     * @var UserInterface | null
     */
    protected $user;

    /**
     * @var QueueInterface | null
     */
    protected $queue;

    /**
     * @var LocutionInterface | null
     */
    protected $locution;

    /**
     * @var ConferenceRoomInterface | null
     */
    protected $conferenceRoom;

    /**
     * @var ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        int $priority
    ) {
        $this->setPriority($priority);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesCondition",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ConditionalRoutesConditionDto
    {
        return new ConditionalRoutesConditionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRoutesConditionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRoutesConditionDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function toDto(int $depth = 0): ConditionalRoutesConditionDto
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

    protected function __toArray(): array
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

    protected function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    protected function setRouteType(?string $routeType = null): static
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

    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    protected function setNumberValue(?string $numberValue = null): static
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    protected function setFriendValue(?string $friendValue = null): static
    {
        if (!is_null($friendValue)) {
            Assertion::maxLength($friendValue, 25, 'friendValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->friendValue = $friendValue;

        return $this;
    }

    public function getFriendValue(): ?string
    {
        return $this->friendValue;
    }

    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute): static
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    public function getConditionalRoute(): ConditionalRouteInterface
    {
        return $this->conditionalRoute;
    }

    protected function setIvr(?IvrInterface $ivr = null): static
    {
        $this->ivr = $ivr;

        return $this;
    }

    public function getIvr(): ?IvrInterface
    {
        return $this->ivr;
    }

    protected function setHuntGroup(?HuntGroupInterface $huntGroup = null): static
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    public function getHuntGroup(): ?HuntGroupInterface
    {
        return $this->huntGroup;
    }

    protected function setVoicemailUser(?UserInterface $voicemailUser = null): static
    {
        $this->voicemailUser = $voicemailUser;

        return $this;
    }

    public function getVoicemailUser(): ?UserInterface
    {
        return $this->voicemailUser;
    }

    protected function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    protected function setQueue(?QueueInterface $queue = null): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function getQueue(): ?QueueInterface
    {
        return $this->queue;
    }

    protected function setLocution(?LocutionInterface $locution = null): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
    }

    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): static
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    public function getConferenceRoom(): ?ConferenceRoomInterface
    {
        return $this->conferenceRoom;
    }

    protected function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setNumberCountry(?CountryInterface $numberCountry = null): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }
}
