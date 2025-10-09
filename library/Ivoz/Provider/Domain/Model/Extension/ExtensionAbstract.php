<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Extension;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Locution\Locution;

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
     * @var ?string
     * comment: enum:user|number|ivr|huntGroup|conferenceRoom|friend|queue|conditional|voicemail|locution
     */
    protected $routeType = null;

    /**
     * @var ?string
     */
    protected $numberValue = null;

    /**
     * @var ?string
     */
    protected $friendValue = null;

    /**
     * @var CompanyInterface
     * inversedBy extensions
     */
    protected $company;

    /**
     * @var ?IvrInterface
     */
    protected $ivr = null;

    /**
     * @var ?HuntGroupInterface
     */
    protected $huntGroup = null;

    /**
     * @var ?ConferenceRoomInterface
     */
    protected $conferenceRoom = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?QueueInterface
     */
    protected $queue = null;

    /**
     * @var ?ConditionalRouteInterface
     */
    protected $conditionalRoute = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?LocutionInterface
     */
    protected $locution = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $number
    ) {
        $this->setNumber($number);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Extension",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ExtensionDto
    {
        return new ExtensionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ExtensionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExtensionDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExtensionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExtensionDto::class);
        $number = $dto->getNumber();
        Assertion::notNull($number, 'getNumber value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $number
        );

        $self
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($company))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setLocution($fkTransformer->transform($dto->getLocution()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ExtensionDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ExtensionDto::class);

        $number = $dto->getNumber();
        Assertion::notNull($number, 'getNumber value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setNumber($number)
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($company))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
            ->setLocution($fkTransformer->transform($dto->getLocution()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExtensionDto
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
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth))
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
            ->setLocution(Locution::entityToDto(self::getLocution(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'number' => self::getNumber(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'friendValue' => self::getFriendValue(),
            'companyId' => self::getCompany()->getId(),
            'ivrId' => self::getIvr()?->getId(),
            'huntGroupId' => self::getHuntGroup()?->getId(),
            'conferenceRoomId' => self::getConferenceRoom()?->getId(),
            'userId' => self::getUser()?->getId(),
            'queueId' => self::getQueue()?->getId(),
            'conditionalRouteId' => self::getConditionalRoute()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'locutionId' => self::getLocution()?->getId()
        ];
    }

    protected function setNumber(string $number): static
    {
        Assertion::maxLength($number, 10, 'number value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->number = $number;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    protected function setRouteType(?string $routeType = null): static
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
                    ExtensionInterface::ROUTETYPE_VOICEMAIL,
                    ExtensionInterface::ROUTETYPE_LOCUTION,
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

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
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

    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): static
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    public function getConferenceRoom(): ?ConferenceRoomInterface
    {
        return $this->conferenceRoom;
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

    protected function setConditionalRoute(?ConditionalRouteInterface $conditionalRoute = null): static
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    public function getConditionalRoute(): ?ConditionalRouteInterface
    {
        return $this->conditionalRoute;
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

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
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
}
