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
     * @var ConferenceRoomInterface | null
     */
    protected $conferenceRoom;

    /**
     * @var LanguageInterface | null
     */
    protected $language;

    /**
     * @var QueueInterface | null
     */
    protected $queue;

    /**
     * @var ExternalCallFilterInterface | null
     */
    protected $externalCallFilter;

    /**
     * @var UserInterface | null
     */
    protected $user;

    /**
     * @var IvrInterface | null
     */
    protected $ivr;

    /**
     * @var HuntGroupInterface | null
     */
    protected $huntGroup;

    /**
     * @var FaxInterface | null
     */
    protected $fax;

    /**
     * @var DdiProviderInterface | null
     */
    protected $ddiProvider;

    /**
     * @var CountryInterface | null
     */
    protected $country;

    /**
     * @var ResidentialDeviceInterface | null
     * inversedBy ddis
     */
    protected $residentialDevice;

    /**
     * @var ConditionalRouteInterface | null
     */
    protected $conditionalRoute;

    /**
     * @var RetailAccountInterface | null
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
     * @param mixed $id
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
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'conditionalRouteId' => self::getConditionalRoute() ? self::getConditionalRoute()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
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
        Assertion::between(intval($billInboundCalls), 0, 1, 'billInboundCalls provided "%s" is not a valid boolean value.');
        $billInboundCalls = (bool) $billInboundCalls;

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

        /** @var  $this */
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

        /** @var  $this */
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

        /** @var  $this */
        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }
}
