<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ddi;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

/**
* DdiAbstract
* @codeCoverageIgnore
*/
abstract class DdiAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: Ddi
     */
    protected $ddi;

    /**
     * @var ?string
     * column: DdiE164
     */
    protected $ddie164 = null;

    /**
     * @var string
     * comment: enum:none|all|inbound|outbound
     */
    protected $recordCalls = 'none';

    /**
     * @var ?string
     */
    protected $displayName = null;

    /**
     * @var ?string
     * comment: enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential|retail
     */
    protected $routeType = null;

    /**
     * @var bool
     */
    protected $billInboundCalls = false;

    /**
     * @var ?string
     */
    protected $friendValue = null;

    /**
     * @var CompanyInterface
     * inversedBy ddis
     */
    protected $company;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var ?ConferenceRoomInterface
     */
    protected $conferenceRoom = null;

    /**
     * @var ?LanguageInterface
     */
    protected $language = null;

    /**
     * @var ?QueueInterface
     */
    protected $queue = null;

    /**
     * @var ?ExternalCallFilterInterface
     */
    protected $externalCallFilter = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?IvrInterface
     */
    protected $ivr = null;

    /**
     * @var ?HuntGroupInterface
     */
    protected $huntGroup = null;

    /**
     * @var ?FaxInterface
     */
    protected $fax = null;

    /**
     * @var ?DdiProviderInterface
     */
    protected $ddiProvider = null;

    /**
     * @var ?CountryInterface
     */
    protected $country = null;

    /**
     * @var ?ResidentialDeviceInterface
     * inversedBy ddis
     */
    protected $residentialDevice = null;

    /**
     * @var ?ConditionalRouteInterface
     */
    protected $conditionalRoute = null;

    /**
     * @var ?RetailAccountInterface
     * inversedBy ddis
     */
    protected $retailAccount = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $ddi,
        string $recordCalls,
        bool $billInboundCalls
    ) {
        $this->setDdi($ddi);
        $this->setRecordCalls($recordCalls);
        $this->setBillInboundCalls($billInboundCalls);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Ddi",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DdiDto
    {
        return new DdiDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DdiInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DdiInterface::class);

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
     * @param DdiDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiDto::class);
        $ddi = $dto->getDdi();
        Assertion::notNull($ddi, 'getDdi value is null, but non null value was expected.');
        $recordCalls = $dto->getRecordCalls();
        Assertion::notNull($recordCalls, 'getRecordCalls value is null, but non null value was expected.');
        $billInboundCalls = $dto->getBillInboundCalls();
        Assertion::notNull($billInboundCalls, 'getBillInboundCalls value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
            $ddi,
            $recordCalls,
            $billInboundCalls
        );

        $self
            ->setDdie164($dto->getDdie164())
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($company))
            ->setBrand($fkTransformer->transform($brand))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setExternalCallFilter($fkTransformer->transform($dto->getExternalCallFilter()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DdiDto::class);

        $ddi = $dto->getDdi();
        Assertion::notNull($ddi, 'getDdi value is null, but non null value was expected.');
        $recordCalls = $dto->getRecordCalls();
        Assertion::notNull($recordCalls, 'getRecordCalls value is null, but non null value was expected.');
        $billInboundCalls = $dto->getBillInboundCalls();
        Assertion::notNull($billInboundCalls, 'getBillInboundCalls value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setDdi($ddi)
            ->setDdie164($dto->getDdie164())
            ->setRecordCalls($recordCalls)
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setBillInboundCalls($billInboundCalls)
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($company))
            ->setBrand($fkTransformer->transform($brand))
            ->setConferenceRoom($fkTransformer->transform($dto->getConferenceRoom()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setExternalCallFilter($fkTransformer->transform($dto->getExternalCallFilter()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setHuntGroup($fkTransformer->transform($dto->getHuntGroup()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
            ->setCountry($fkTransformer->transform($dto->getCountry()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setConditionalRoute($fkTransformer->transform($dto->getConditionalRoute()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiDto
    {
        return self::createDto()
            ->setDdi(self::getDdi())
            ->setDdie164(self::getDdie164())
            ->setRecordCalls(self::getRecordCalls())
            ->setDisplayName(self::getDisplayName())
            ->setRouteType(self::getRouteType())
            ->setBillInboundCalls(self::getBillInboundCalls())
            ->setFriendValue(self::getFriendValue())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setConferenceRoom(ConferenceRoom::entityToDto(self::getConferenceRoom(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth))
            ->setExternalCallFilter(ExternalCallFilter::entityToDto(self::getExternalCallFilter(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setFax(Fax::entityToDto(self::getFax(), $depth))
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth))
            ->setCountry(Country::entityToDto(self::getCountry(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setConditionalRoute(ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'Ddi' => self::getDdi(),
            'DdiE164' => self::getDdie164(),
            'recordCalls' => self::getRecordCalls(),
            'displayName' => self::getDisplayName(),
            'routeType' => self::getRouteType(),
            'billInboundCalls' => self::getBillInboundCalls(),
            'friendValue' => self::getFriendValue(),
            'companyId' => self::getCompany()->getId(),
            'brandId' => self::getBrand()->getId(),
            'conferenceRoomId' => self::getConferenceRoom()?->getId(),
            'languageId' => self::getLanguage()?->getId(),
            'queueId' => self::getQueue()?->getId(),
            'externalCallFilterId' => self::getExternalCallFilter()?->getId(),
            'userId' => self::getUser()?->getId(),
            'ivrId' => self::getIvr()?->getId(),
            'huntGroupId' => self::getHuntGroup()?->getId(),
            'faxId' => self::getFax()?->getId(),
            'ddiProviderId' => self::getDdiProvider()?->getId(),
            'countryId' => self::getCountry()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'conditionalRouteId' => self::getConditionalRoute()?->getId(),
            'retailAccountId' => self::getRetailAccount()?->getId()
        ];
    }

    protected function setDdi(string $ddi): static
    {
        Assertion::maxLength($ddi, 25, 'ddi value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): string
    {
        return $this->ddi;
    }

    protected function setDdie164(?string $ddie164 = null): static
    {
        if (!is_null($ddie164)) {
            Assertion::maxLength($ddie164, 25, 'ddie164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ddie164 = $ddie164;

        return $this;
    }

    public function getDdie164(): ?string
    {
        return $this->ddie164;
    }

    protected function setRecordCalls(string $recordCalls): static
    {
        Assertion::maxLength($recordCalls, 25, 'recordCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $recordCalls,
            [
                DdiInterface::RECORDCALLS_NONE,
                DdiInterface::RECORDCALLS_ALL,
                DdiInterface::RECORDCALLS_INBOUND,
                DdiInterface::RECORDCALLS_OUTBOUND,
            ],
            'recordCallsvalue "%s" is not an element of the valid values: %s'
        );

        $this->recordCalls = $recordCalls;

        return $this;
    }

    public function getRecordCalls(): string
    {
        return $this->recordCalls;
    }

    protected function setDisplayName(?string $displayName = null): static
    {
        if (!is_null($displayName)) {
            Assertion::maxLength($displayName, 50, 'displayName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->displayName = $displayName;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    protected function setRouteType(?string $routeType = null): static
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routeType,
                [
                    DdiInterface::ROUTETYPE_USER,
                    DdiInterface::ROUTETYPE_IVR,
                    DdiInterface::ROUTETYPE_HUNTGROUP,
                    DdiInterface::ROUTETYPE_FAX,
                    DdiInterface::ROUTETYPE_CONFERENCEROOM,
                    DdiInterface::ROUTETYPE_FRIEND,
                    DdiInterface::ROUTETYPE_QUEUE,
                    DdiInterface::ROUTETYPE_CONDITIONAL,
                    DdiInterface::ROUTETYPE_RESIDENTIAL,
                    DdiInterface::ROUTETYPE_RETAIL,
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

    protected function setBillInboundCalls(bool $billInboundCalls): static
    {
        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    public function getBillInboundCalls(): bool
    {
        return $this->billInboundCalls;
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

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
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

    protected function setLanguage(?LanguageInterface $language = null): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
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

    protected function setExternalCallFilter(?ExternalCallFilterInterface $externalCallFilter = null): static
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    public function getExternalCallFilter(): ?ExternalCallFilterInterface
    {
        return $this->externalCallFilter;
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

    protected function setFax(?FaxInterface $fax = null): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }

    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }

    protected function setCountry(?CountryInterface $country = null): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
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

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }
}
