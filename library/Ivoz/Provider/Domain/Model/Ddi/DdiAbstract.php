<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Ddi;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * column: Ddi
     * @var string
     */
    protected $ddi;

    /**
     * column: DdiE164
     * @var string | null
     */
    protected $ddie164;

    /**
     * comment: enum:none|all|inbound|outbound
     * @var string
     */
    protected $recordCalls = 'none';

    /**
     * @var string | null
     */
    protected $displayName;

    /**
     * comment: enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|conditional|residential|retail
     * @var string | null
     */
    protected $routeType;

    /**
     * @var bool
     */
    protected $billInboundCalls = false;

    /**
     * @var string | null
     */
    protected $friendValue;

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
     * @var ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * @var ExternalCallFilterInterface
     */
    protected $externalCallFilter;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var IvrInterface
     */
    protected $ivr;

    /**
     * @var HuntGroupInterface
     */
    protected $huntGroup;

    /**
     * @var FaxInterface
     */
    protected $fax;

    /**
     * @var DdiProviderInterface
     */
    protected $ddiProvider;

    /**
     * @var CountryInterface
     */
    protected $country;

    /**
     * @var ResidentialDeviceInterface
     * inversedBy ddis
     */
    protected $residentialDevice;

    /**
     * @var ConditionalRouteInterface
     */
    protected $conditionalRoute;

    /**
     * @var RetailAccountInterface
     * inversedBy ddis
     */
    protected $retailAccount;

    /**
     * Constructor
     */
    protected function __construct(
        $ddi,
        $recordCalls,
        $billInboundCalls
    ) {
        $this->setDdi($ddi);
        $this->setRecordCalls($recordCalls);
        $this->setBillInboundCalls($billInboundCalls);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Ddi",
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
     * @return DdiDto
     */
    public static function createDto($id = null)
    {
        return new DdiDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DdiInterface|null $entity
     * @param int $depth
     * @return DdiDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var DdiDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiDto::class);

        $self = new static(
            $dto->getDdi(),
            $dto->getRecordCalls(),
            $dto->getBillInboundCalls()
        );

        $self
            ->setDdie164($dto->getDdie164())
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiDto::class);

        $this
            ->setDdi($dto->getDdi())
            ->setDdie164($dto->getDdie164())
            ->setRecordCalls($dto->getRecordCalls())
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setBillInboundCalls($dto->getBillInboundCalls())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
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
     * @param int $depth
     * @return DdiDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
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
            'conferenceRoomId' => self::getConferenceRoom() ? self::getConferenceRoom()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null,
            'externalCallFilterId' => self::getExternalCallFilter() ? self::getExternalCallFilter()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'faxId' => self::getFax() ? self::getFax()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null,
            'countryId' => self::getCountry()->getId(),
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'conditionalRouteId' => self::getConditionalRoute() ? self::getConditionalRoute()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
        ];
    }

    /**
     * Set ddi
     *
     * @param string $ddi
     *
     * @return static
     */
    protected function setDdi(string $ddi): DdiInterface
    {
        Assertion::maxLength($ddi, 25, 'ddi value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return string
     */
    public function getDdi(): string
    {
        return $this->ddi;
    }

    /**
     * Set ddie164
     *
     * @param string $ddie164 | null
     *
     * @return static
     */
    protected function setDdie164(?string $ddie164 = null): DdiInterface
    {
        if (!is_null($ddie164)) {
            Assertion::maxLength($ddie164, 25, 'ddie164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ddie164 = $ddie164;

        return $this;
    }

    /**
     * Get ddie164
     *
     * @return string | null
     */
    public function getDdie164(): ?string
    {
        return $this->ddie164;
    }

    /**
     * Set recordCalls
     *
     * @param string $recordCalls
     *
     * @return static
     */
    protected function setRecordCalls(string $recordCalls): DdiInterface
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

    /**
     * Get recordCalls
     *
     * @return string
     */
    public function getRecordCalls(): string
    {
        return $this->recordCalls;
    }

    /**
     * Set displayName
     *
     * @param string $displayName | null
     *
     * @return static
     */
    protected function setDisplayName(?string $displayName = null): DdiInterface
    {
        if (!is_null($displayName)) {
            Assertion::maxLength($displayName, 50, 'displayName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string | null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set routeType
     *
     * @param string $routeType | null
     *
     * @return static
     */
    protected function setRouteType(?string $routeType = null): DdiInterface
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
     * Set billInboundCalls
     *
     * @param bool $billInboundCalls
     *
     * @return static
     */
    protected function setBillInboundCalls(bool $billInboundCalls): DdiInterface
    {
        Assertion::between(intval($billInboundCalls), 0, 1, 'billInboundCalls provided "%s" is not a valid boolean value.');
        $billInboundCalls = (bool) $billInboundCalls;

        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * Get billInboundCalls
     *
     * @return bool
     */
    public function getBillInboundCalls(): bool
    {
        return $this->billInboundCalls;
    }

    /**
     * Set friendValue
     *
     * @param string $friendValue | null
     *
     * @return static
     */
    protected function setFriendValue(?string $friendValue = null): DdiInterface
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
    public function setCompany(CompanyInterface $company): DdiInterface
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
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): DdiInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set conferenceRoom
     *
     * @param ConferenceRoomInterface | null
     *
     * @return static
     */
    protected function setConferenceRoom(?ConferenceRoomInterface $conferenceRoom = null): DdiInterface
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
     * Set language
     *
     * @param LanguageInterface | null
     *
     * @return static
     */
    protected function setLanguage(?LanguageInterface $language = null): DdiInterface
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    /**
     * Set queue
     *
     * @param QueueInterface | null
     *
     * @return static
     */
    protected function setQueue(?QueueInterface $queue = null): DdiInterface
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
     * Set externalCallFilter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    protected function setExternalCallFilter(?ExternalCallFilterInterface $externalCallFilter = null): DdiInterface
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    /**
     * Get externalCallFilter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getExternalCallFilter(): ?ExternalCallFilterInterface
    {
        return $this->externalCallFilter;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): DdiInterface
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
     * Set ivr
     *
     * @param IvrInterface | null
     *
     * @return static
     */
    protected function setIvr(?IvrInterface $ivr = null): DdiInterface
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
    protected function setHuntGroup(?HuntGroupInterface $huntGroup = null): DdiInterface
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
     * Set fax
     *
     * @param FaxInterface | null
     *
     * @return static
     */
    protected function setFax(?FaxInterface $fax = null): DdiInterface
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface | null
     *
     * @return static
     */
    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): DdiInterface
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }

    /**
     * Set country
     *
     * @param CountryInterface
     *
     * @return static
     */
    protected function setCountry(CountryInterface $country): DdiInterface
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return CountryInterface
     */
    public function getCountry(): CountryInterface
    {
        return $this->country;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): DdiInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    /**
     * Set conditionalRoute
     *
     * @param ConditionalRouteInterface | null
     *
     * @return static
     */
    protected function setConditionalRoute(?ConditionalRouteInterface $conditionalRoute = null): DdiInterface
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
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): DdiInterface
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

}
