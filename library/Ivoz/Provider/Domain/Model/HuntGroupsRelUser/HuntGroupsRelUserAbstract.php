<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* HuntGroupsRelUserAbstract
* @codeCoverageIgnore
*/
abstract class HuntGroupsRelUserAbstract
{
    use ChangelogTrait;

    /**
     * @var int | null
     */
    protected $timeoutTime;

    /**
     * @var int | null
     */
    protected $priority;

    /**
     * comment: enum:number|user
     * @var string
     */
    protected $routeType;

    /**
     * @var string | null
     */
    protected $numberValue;

    /**
     * @var HuntGroupInterface
     * inversedBy huntGroupsRelUsers
     */
    protected $huntGroup;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var CountryInterface
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $routeType
    ) {
        $this->setRouteType($routeType);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "HuntGroupsRelUser",
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
     * @return HuntGroupsRelUserDto
     */
    public static function createDto($id = null)
    {
        return new HuntGroupsRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserInterface|null $entity
     * @param int $depth
     * @return HuntGroupsRelUserDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HuntGroupsRelUserInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var HuntGroupsRelUserDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDto::class);

        $self = new static(
            $dto->getRouteType()
        );

        $self
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setNumberValue($dto->getNumberValue())
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param HuntGroupsRelUserDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDto::class);

        $this
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return HuntGroupsRelUserDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTimeoutTime(self::getTimeoutTime())
            ->setPriority(self::getPriority())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setHuntGroup(HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'timeoutTime' => self::getTimeoutTime(),
            'priority' => self::getPriority(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }

    /**
     * Set timeoutTime
     *
     * @param int $timeoutTime | null
     *
     * @return static
     */
    protected function setTimeoutTime(?int $timeoutTime = null): HuntGroupsRelUserInterface
    {
        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    /**
     * Get timeoutTime
     *
     * @return int | null
     */
    public function getTimeoutTime(): ?int
    {
        return $this->timeoutTime;
    }

    /**
     * Set priority
     *
     * @param int $priority | null
     *
     * @return static
     */
    protected function setPriority(?int $priority = null): HuntGroupsRelUserInterface
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * Set routeType
     *
     * @param string $routeType
     *
     * @return static
     */
    protected function setRouteType(string $routeType): HuntGroupsRelUserInterface
    {
        Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $routeType,
            [
                HuntGroupsRelUserInterface::ROUTETYPE_NUMBER,
                HuntGroupsRelUserInterface::ROUTETYPE_USER,
            ],
            'routeTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType(): string
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
    protected function setNumberValue(?string $numberValue = null): HuntGroupsRelUserInterface
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
     * Set huntGroup
     *
     * @param HuntGroupInterface | null
     *
     * @return static
     */
    public function setHuntGroup(?HuntGroupInterface $huntGroup = null): HuntGroupsRelUserInterface
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
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): HuntGroupsRelUserInterface
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
     * Set numberCountry
     *
     * @param CountryInterface | null
     *
     * @return static
     */
    protected function setNumberCountry(?CountryInterface $numberCountry = null): HuntGroupsRelUserInterface
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
