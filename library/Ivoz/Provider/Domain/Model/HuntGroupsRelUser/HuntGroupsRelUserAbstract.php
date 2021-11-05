<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $timeoutTime;

    protected $priority;

    /**
     * comment: enum:number|user
     */
    protected $routeType;

    protected $numberValue;

    /**
     * @var HuntGroupInterface | null
     * inversedBy huntGroupsRelUsers
     */
    protected $huntGroup;

    /**
     * @var UserInterface | null
     */
    protected $user;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        string $routeType
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
     * @param mixed $id
     */
    public static function createDto($id = null): HuntGroupsRelUserDto
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
        $dto = $entity->toDto($depth - 1);

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
     */
    public function toDto($depth = 0): HuntGroupsRelUserDto
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

    protected function setTimeoutTime(?int $timeoutTime = null): static
    {
        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    public function getTimeoutTime(): ?int
    {
        return $this->timeoutTime;
    }

    protected function setPriority(?int $priority = null): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    protected function setRouteType(string $routeType): static
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

    public function getRouteType(): string
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

    public function setHuntGroup(?HuntGroupInterface $huntGroup = null): static
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    public function getHuntGroup(): ?HuntGroupInterface
    {
        return $this->huntGroup;
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
