<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroupMember;

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
* HuntGroupMemberAbstract
* @codeCoverageIgnore
*/
abstract class HuntGroupMemberAbstract
{
    use ChangelogTrait;

    /**
     * @var ?int
     */
    protected $timeoutTime = null;

    /**
     * @var ?int
     */
    protected $priority = null;

    /**
     * @var string
     * comment: enum:number|user
     */
    protected $routeType;

    /**
     * @var ?string
     */
    protected $numberValue = null;

    /**
     * @var ?HuntGroupInterface
     * inversedBy huntGroupMembers
     */
    protected $huntGroup = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $routeType
    ) {
        $this->setRouteType($routeType);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "HuntGroupMember",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): HuntGroupMemberDto
    {
        return new HuntGroupMemberDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|HuntGroupMemberInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HuntGroupMemberDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HuntGroupMemberInterface::class);

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
     * @param HuntGroupMemberDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HuntGroupMemberDto::class);
        $routeType = $dto->getRouteType();
        Assertion::notNull($routeType, 'getRouteType value is null, but non null value was expected.');

        $self = new static(
            $routeType
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
     * @param HuntGroupMemberDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, HuntGroupMemberDto::class);

        $routeType = $dto->getRouteType();
        Assertion::notNull($routeType, 'getRouteType value is null, but non null value was expected.');

        $this
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setRouteType($routeType)
            ->setNumberValue($dto->getNumberValue())
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HuntGroupMemberDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'timeoutTime' => self::getTimeoutTime(),
            'priority' => self::getPriority(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'huntGroupId' => self::getHuntGroup()?->getId(),
            'userId' => self::getUser()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId()
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
                HuntGroupMemberInterface::ROUTETYPE_NUMBER,
                HuntGroupMemberInterface::ROUTETYPE_USER,
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
