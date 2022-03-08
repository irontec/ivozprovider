<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
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
     * @var ?string
     * column: routeType
     * comment: enum:user|number|ivr|huntGroup|voicemail|friend|queue|conferenceRoom|extension
     */
    protected $routetype = null;

    /**
     * @var ?string
     * column: numberValue
     */
    protected $numbervalue = null;

    /**
     * @var ?string
     * column: friendValue
     */
    protected $friendvalue = null;

    /**
     * @var CompanyInterface
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
     * @var ?VoicemailInterface
     */
    protected $voicemail = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?QueueInterface
     */
    protected $queue = null;

    /**
     * @var ?LocutionInterface
     */
    protected $locution = null;

    /**
     * @var ?ConferenceRoomInterface
     */
    protected $conferenceRoom = null;

    /**
     * @var ?ExtensionInterface
     */
    protected $extension = null;

    /**
     * @var ?CountryInterface
     */
    protected $numberCountry = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name
    ) {
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoute",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ConditionalRouteDto
    {
        return new ConditionalRouteDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRouteInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRouteDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRouteDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name
        );

        $self
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($fkTransformer->transform($company))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRouteDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setRoutetype($dto->getRoutetype())
            ->setNumbervalue($dto->getNumbervalue())
            ->setFriendvalue($dto->getFriendvalue())
            ->setCompany($fkTransformer->transform($company))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()))
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
    public function toDto(int $depth = 0): ConditionalRouteDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setRoutetype(self::getRoutetype())
            ->setNumbervalue(self::getNumbervalue())
            ->setFriendvalue(self::getFriendvalue())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth))
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
            'name' => self::getName(),
            'routeType' => self::getRoutetype(),
            'numberValue' => self::getNumbervalue(),
            'friendValue' => self::getFriendvalue(),
            'companyId' => self::getCompany()->getId(),
            'ivrId' => self::getIvr()?->getId(),
            'huntGroupId' => self::getHuntGroup()?->getId(),
            'voicemailId' => self::getVoicemail()?->getId(),
            'userId' => self::getUser()?->getId(),
            'queueId' => self::getQueue()?->getId(),
            'locutionId' => self::getLocution()?->getId(),
            'conferenceRoomId' => self::getConferenceRoom()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'numberCountryId' => self::getNumberCountry()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setRoutetype(?string $routetype = null): static
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

    public function getRoutetype(): ?string
    {
        return $this->routetype;
    }

    protected function setNumbervalue(?string $numbervalue = null): static
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25, 'numbervalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numbervalue = $numbervalue;

        return $this;
    }

    public function getNumbervalue(): ?string
    {
        return $this->numbervalue;
    }

    protected function setFriendvalue(?string $friendvalue = null): static
    {
        if (!is_null($friendvalue)) {
            Assertion::maxLength($friendvalue, 25, 'friendvalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->friendvalue = $friendvalue;

        return $this;
    }

    public function getFriendvalue(): ?string
    {
        return $this->friendvalue;
    }

    protected function setCompany(CompanyInterface $company): static
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

    protected function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
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
