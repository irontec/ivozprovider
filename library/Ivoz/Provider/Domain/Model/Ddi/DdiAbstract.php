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
     * @var string
     */
    protected $ddie164;

    /**
     * comment: enum:none|all|inbound|outbound
     * @var string
     */
    protected $recordCalls = 'none';

    /**
     * @var string
     */
    protected $displayName;

    /**
     * comment: enum:user|ivr|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional
     * @var string
     */
    protected $routeType;

    /**
     * @var boolean
     */
    protected $billInboundCalls = '0';

    /**
     * @var string
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
     * @var \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    protected $conferenceRoom;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
     */
    protected $externalCallFilter;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    protected $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    protected $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    protected $peeringContract;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     */
    protected $retailAccount;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    protected $conditionalRoute;


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
        return sprintf("%s#%s",
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DdiDto
         */
        Assertion::isInstanceOf($dto, DdiDto::class);

        $self = new static(
            $dto->getDdi(),
            $dto->getRecordCalls(),
            $dto->getBillInboundCalls());

        $self
            ->setDdie164($dto->getDdie164())
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($dto->getCompany())
            ->setBrand($dto->getBrand())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setLanguage($dto->getLanguage())
            ->setQueue($dto->getQueue())
            ->setExternalCallFilter($dto->getExternalCallFilter())
            ->setUser($dto->getUser())
            ->setIvr($dto->getIvr())
            ->setHuntGroup($dto->getHuntGroup())
            ->setFax($dto->getFax())
            ->setPeeringContract($dto->getPeeringContract())
            ->setCountry($dto->getCountry())
            ->setRetailAccount($dto->getRetailAccount())
            ->setConditionalRoute($dto->getConditionalRoute())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DdiDto
         */
        Assertion::isInstanceOf($dto, DdiDto::class);

        $this
            ->setDdi($dto->getDdi())
            ->setDdie164($dto->getDdie164())
            ->setRecordCalls($dto->getRecordCalls())
            ->setDisplayName($dto->getDisplayName())
            ->setRouteType($dto->getRouteType())
            ->setBillInboundCalls($dto->getBillInboundCalls())
            ->setFriendValue($dto->getFriendValue())
            ->setCompany($dto->getCompany())
            ->setBrand($dto->getBrand())
            ->setConferenceRoom($dto->getConferenceRoom())
            ->setLanguage($dto->getLanguage())
            ->setQueue($dto->getQueue())
            ->setExternalCallFilter($dto->getExternalCallFilter())
            ->setUser($dto->getUser())
            ->setIvr($dto->getIvr())
            ->setHuntGroup($dto->getHuntGroup())
            ->setFax($dto->getFax())
            ->setPeeringContract($dto->getPeeringContract())
            ->setCountry($dto->getCountry())
            ->setRetailAccount($dto->getRetailAccount())
            ->setConditionalRoute($dto->getConditionalRoute());



        $this->sanitizeValues();
        return $this;
    }

    /**
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
            ->setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContract::entityToDto(self::getPeeringContract(), $depth))
            ->setCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getCountry(), $depth))
            ->setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute::entityToDto(self::getConditionalRoute(), $depth));
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
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'conferenceRoomId' => self::getConferenceRoom() ? self::getConferenceRoom()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null,
            'externalCallFilterId' => self::getExternalCallFilter() ? self::getExternalCallFilter()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'faxId' => self::getFax() ? self::getFax()->getId() : null,
            'peeringContractId' => self::getPeeringContract() ? self::getPeeringContract()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null,
            'conditionalRouteId' => self::getConditionalRoute() ? self::getConditionalRoute()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set ddi
     *
     * @param string $ddi
     *
     * @return self
     */
    public function setDdi($ddi)
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
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * Set ddie164
     *
     * @param string $ddie164
     *
     * @return self
     */
    public function setDdie164($ddie164 = null)
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
     * @return string
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
     * @return self
     */
    public function setRecordCalls($recordCalls)
    {
        Assertion::notNull($recordCalls, 'recordCalls value "%s" is null, but non null value was expected.');
        Assertion::maxLength($recordCalls, 25, 'recordCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($recordCalls, array (
          0 => 'none',
          1 => 'all',
          2 => 'inbound',
          3 => 'outbound',
        ), 'recordCallsvalue "%s" is not an element of the valid values: %s');

        $this->recordCalls = $recordCalls;

        return $this;
    }

    /**
     * Get recordCalls
     *
     * @return string
     */
    public function getRecordCalls()
    {
        return $this->recordCalls;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return self
     */
    public function setDisplayName($displayName = null)
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
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set routeType
     *
     * @param string $routeType
     *
     * @return self
     */
    public function setRouteType($routeType = null)
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($routeType, array (
          0 => 'user',
          1 => 'ivr',
          2 => 'huntGroup',
          3 => 'fax',
          4 => 'conferenceRoom',
          5 => 'friend',
          6 => 'queue',
          7 => 'retailAccount',
          8 => 'conditional',
        ), 'routeTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string
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
     * @return self
     */
    public function setBillInboundCalls($billInboundCalls)
    {
        Assertion::notNull($billInboundCalls, 'billInboundCalls value "%s" is null, but non null value was expected.');
        Assertion::between(intval($billInboundCalls), 0, 1, 'billInboundCalls provided "%s" is not a valid boolean value.');

        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * Get billInboundCalls
     *
     * @return boolean
     */
    public function getBillInboundCalls()
    {
        return $this->billInboundCalls;
    }

    /**
     * Set friendValue
     *
     * @param string $friendValue
     *
     * @return self
     */
    public function setFriendValue($friendValue = null)
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
     * @return string
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
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
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
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom
     *
     * @return self
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null)
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return self
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set externalCallFilter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter
     *
     * @return self
     */
    public function setExternalCallFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter = null)
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    /**
     * Get externalCallFilter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface
     */
    public function getExternalCallFilter()
    {
        return $this->externalCallFilter;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr
     *
     * @return self
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup
     *
     * @return self
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax
     *
     * @return self
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return self
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute
     *
     * @return self
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }



    // @codeCoverageIgnoreEnd
}

