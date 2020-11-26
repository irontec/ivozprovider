<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Extension;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* ExtensionAbstract
* @codeCoverageIgnore
*/
abstract class ExtensionAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $number;

    /**
     * comment: enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional
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
     * @var CompanyInterface
     * inversedBy extensions
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
     * @var ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * @var ConditionalRouteInterface
     */
    protected $conditionalRoute;

    /**
     * @var CountryInterface
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $number
    ) {
        $this->setNumber($number);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Extension",
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
     * @return ExtensionDto
     */
    public static function createDto($id = null)
    {
        return new ExtensionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ExtensionInterface|null $entity
     * @param int $depth
     * @return ExtensionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ExtensionInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ExtensionDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExtensionDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExtensionDto::class);

        $self = new static(
            $dto->getNumber()
        );

        $self
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExtensionDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ExtensionDto::class);

        $this
            ->setNumber($dto->getNumber())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExtensionDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setNumber(self::getNumber())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setFriendValue(self::getFriendValue())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setConferenceRoom(ConferenceRoom::entityToDto(self::getConferenceRoom(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth))
            ->setConditionalRoute(ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'number' => self::getNumber(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'friendValue' => self::getFriendValue(),
            'companyId' => self::getCompany()->getId(),
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'conferenceRoomId' => self::getConferenceRoom() ? self::getConferenceRoom()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null,
            'conditionalRouteId' => self::getConditionalRoute() ? self::getConditionalRoute()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return static
     */
    protected function setNumber(string $number): ExtensionInterface
    {
        Assertion::maxLength($number, 10, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set routeType
     *
     * @param string $routeType | null
     *
     * @return static
     */
    protected function setRouteType(?string $routeType = null): ExtensionInterface
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routeType,
                [
                    ExtensionInterface::ROUTETYPE_USER,
                    ExtensionInterface::ROUTETYPE_NUMBER,
                    ExtensionInterface::ROUTETYPE_IVR,
                    ExtensionInterface::ROUTETYPE_HUNTGROUP,
                    ExtensionInterface::ROUTETYPE_CONFERENCEROOM,
                    ExtensionInterface::ROUTETYPE_FRIEND,
                    ExtensionInterface::ROUTETYPE_QUEUE,
                    ExtensionInterface::ROUTETYPE_CONDITIONAL,
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
    protected function setNumberValue(?string $numberValue = null): ExtensionInterface
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
    protected function setFriendValue(?string $friendValue = null): ExtensionInterface
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
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): ExtensionInterface
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
    protected function setIvr(?IvrInterface $ivr = null): ExtensionInterface
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
    protected function setHuntGroup(?HuntGroupInterface $huntGroup = null): ExtensionInterface
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
     * Set conferenceRoom
     *
     * @param ConferenceRoomInterface | null
     *
     * @return static
     */
    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): ExtensionInterface
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
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): ExtensionInterface
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
    protected function setQueue(?QueueInterface $queue = null): ExtensionInterface
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
     * Set conditionalRoute
     *
     * @param ConditionalRouteInterface | null
     *
     * @return static
     */
    protected function setConditionalRoute(?ConditionalRouteInterface $conditionalRoute = null): ExtensionInterface
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface | null
     */
    public function getConditionalRoute(): ?ConditionalRouteInterface
    {
        return $this->conditionalRoute;
    }

    /**
     * Set numberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNumberCountry(?CountryInterface $numberCountry = null): ExtensionInterface
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
