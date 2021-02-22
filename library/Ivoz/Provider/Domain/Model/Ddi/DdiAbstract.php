<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DdiAbstract
 * @codeCoverageIgnore
 */
abstract class DdiAbstract
{
    /**
     * @var string
     */
    protected $ddi;

    /**
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
     * @var boolean
     */
    protected $billInboundCalls = false;

    /**
     * @var string | null
     */
    protected $friendValue;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface | null
     */
    protected $conferenceRoom;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface | null
     */
    protected $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    protected $externalCallFilter;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    protected $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    protected $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    protected $ddiProvider;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    protected $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface | null
     */
    protected $conditionalRoute;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    protected $retailAccount;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($ddi, $recordCalls, $billInboundCalls)
    {
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom::entityToDto(self::getConferenceRoom(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setQueue(\Ivoz\Provider\Domain\Model\Queue\Queue::entityToDto(self::getQueue(), $depth))
            ->setExternalCallFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter::entityToDto(self::getExternalCallFilter(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setIvr(\Ivoz\Provider\Domain\Model\Ivr\Ivr::entityToDto(self::getIvr(), $depth))
            ->setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup::entityToDto(self::getHuntGroup(), $depth))
            ->setFax(\Ivoz\Provider\Domain\Model\Fax\Fax::entityToDto(self::getFax(), $depth))
            ->setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::entityToDto(self::getDdiProvider(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth))
            ->setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth))
            ->setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount::entityToDto(self::getRetailAccount(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set ddi
     *
     * @param string $ddi
     *
     * @return static
     */
    protected function setDdi($ddi)
    {
        Assertion::notNull($ddi, 'ddi value "%s" is null, but non null value was expected.');
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
    protected function setDdie164($ddie164 = null)
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
    public function getDdie164()
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
    protected function setRecordCalls($recordCalls)
    {
        Assertion::notNull($recordCalls, 'recordCalls value "%s" is null, but non null value was expected.');
        Assertion::maxLength($recordCalls, 25, 'recordCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($recordCalls, [
            DdiInterface::RECORDCALLS_NONE,
            DdiInterface::RECORDCALLS_ALL,
            DdiInterface::RECORDCALLS_INBOUND,
            DdiInterface::RECORDCALLS_OUTBOUND
        ], 'recordCallsvalue "%s" is not an element of the valid values: %s');

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
    protected function setDisplayName($displayName = null)
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
    public function getDisplayName()
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
    protected function setRouteType($routeType = null)
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($routeType, [
                DdiInterface::ROUTETYPE_USER,
                DdiInterface::ROUTETYPE_IVR,
                DdiInterface::ROUTETYPE_HUNTGROUP,
                DdiInterface::ROUTETYPE_FAX,
                DdiInterface::ROUTETYPE_CONFERENCEROOM,
                DdiInterface::ROUTETYPE_FRIEND,
                DdiInterface::ROUTETYPE_QUEUE,
                DdiInterface::ROUTETYPE_CONDITIONAL,
                DdiInterface::ROUTETYPE_RESIDENTIAL,
                DdiInterface::ROUTETYPE_RETAIL
            ], 'routeTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * Set billInboundCalls
     *
     * @param boolean $billInboundCalls
     *
     * @return static
     */
    protected function setBillInboundCalls($billInboundCalls)
    {
        Assertion::notNull($billInboundCalls, 'billInboundCalls value "%s" is null, but non null value was expected.');
        Assertion::between(intval($billInboundCalls), 0, 1, 'billInboundCalls provided "%s" is not a valid boolean value.');
        $billInboundCalls = (bool) $billInboundCalls;

        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * Get billInboundCalls
     *
     * @return boolean
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
    protected function setFriendValue($friendValue = null)
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
    public function getFriendValue()
    {
        return $this->friendValue;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    protected function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set conferenceRoom
     *
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom | null
     *
     * @return static
     */
    protected function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null)
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface | null
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language | null
     *
     * @return static
     */
    protected function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue | null
     *
     * @return static
     */
    protected function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface | null
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set externalCallFilter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter | null
     *
     * @return static
     */
    protected function setExternalCallFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter = null)
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    /**
     * Get externalCallFilter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    public function getExternalCallFilter()
    {
        return $this->externalCallFilter;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    protected function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr | null
     *
     * @return static
     */
    protected function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup | null
     *
     * @return static
     */
    protected function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax | null
     *
     * @return static
     */
    protected function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider | null
     *
     * @return static
     */
    protected function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country | null
     *
     * @return static
     */
    protected function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice | null
     *
     * @return static
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute | null
     *
     * @return static
     */
    protected function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface | null
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount | null
     *
     * @return static
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    // @codeCoverageIgnoreEnd
}
