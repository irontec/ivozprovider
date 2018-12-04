<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DdiDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ddi;

    /**
     * @var string
     */
    private $ddie164;

    /**
     * @var string
     */
    private $recordCalls = 'none';

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $routeType;

    /**
     * @var boolean
     */
    private $billInboundCalls = '0';

    /**
     * @var string
     */
    private $friendValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto | null
     */
    private $conferenceRoom;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueDto | null
     */
    private $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto | null
     */
    private $externalCallFilter;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrDto | null
     */
    private $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto | null
     */
    private $huntGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxDto | null
     */
    private $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto | null
     */
    private $ddiProvider;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto | null
     */
    private $conditionalRoute;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto | null
     */
    private $retailAccount;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'ddi' => 'ddi',
            'ddie164' => 'ddie164',
            'recordCalls' => 'recordCalls',
            'displayName' => 'displayName',
            'routeType' => 'routeType',
            'billInboundCalls' => 'billInboundCalls',
            'friendValue' => 'friendValue',
            'id' => 'id',
            'companyId' => 'company',
            'brandId' => 'brand',
            'conferenceRoomId' => 'conferenceRoom',
            'languageId' => 'language',
            'queueId' => 'queue',
            'externalCallFilterId' => 'externalCallFilter',
            'userId' => 'user',
            'ivrId' => 'ivr',
            'huntGroupId' => 'huntGroup',
            'faxId' => 'fax',
            'ddiProviderId' => 'ddiProvider',
            'countryId' => 'country',
            'residentialDeviceId' => 'residentialDevice',
            'conditionalRouteId' => 'conditionalRoute',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'ddi' => $this->getDdi(),
            'ddie164' => $this->getDdie164(),
            'recordCalls' => $this->getRecordCalls(),
            'displayName' => $this->getDisplayName(),
            'routeType' => $this->getRouteType(),
            'billInboundCalls' => $this->getBillInboundCalls(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'brand' => $this->getBrand(),
            'conferenceRoom' => $this->getConferenceRoom(),
            'language' => $this->getLanguage(),
            'queue' => $this->getQueue(),
            'externalCallFilter' => $this->getExternalCallFilter(),
            'user' => $this->getUser(),
            'ivr' => $this->getIvr(),
            'huntGroup' => $this->getHuntGroup(),
            'fax' => $this->getFax(),
            'ddiProvider' => $this->getDdiProvider(),
            'country' => $this->getCountry(),
            'residentialDevice' => $this->getResidentialDevice(),
            'conditionalRoute' => $this->getConditionalRoute(),
            'retailAccount' => $this->getRetailAccount()
        ];
    }

    /**
     * @param string $ddi
     *
     * @return static
     */
    public function setDdi($ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return string
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * @param string $ddie164
     *
     * @return static
     */
    public function setDdie164($ddie164 = null)
    {
        $this->ddie164 = $ddie164;

        return $this;
    }

    /**
     * @return string
     */
    public function getDdie164()
    {
        return $this->ddie164;
    }

    /**
     * @param string $recordCalls
     *
     * @return static
     */
    public function setRecordCalls($recordCalls = null)
    {
        $this->recordCalls = $recordCalls;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordCalls()
    {
        return $this->recordCalls;
    }

    /**
     * @param string $displayName
     *
     * @return static
     */
    public function setDisplayName($displayName = null)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $routeType
     *
     * @return static
     */
    public function setRouteType($routeType = null)
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * @param boolean $billInboundCalls
     *
     * @return static
     */
    public function setBillInboundCalls($billInboundCalls = null)
    {
        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getBillInboundCalls()
    {
        return $this->billInboundCalls;
    }

    /**
     * @param string $friendValue
     *
     * @return static
     */
    public function setFriendValue($friendValue = null)
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getFriendValue()
    {
        return $this->friendValue;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto $conferenceRoom
     *
     * @return static
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto $conferenceRoom = null)
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto
     */
    public function getConferenceRoom()
    {
        return $this->conferenceRoom;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setConferenceRoomId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto($id)
            : null;

        return $this->setConferenceRoom($value);
    }

    /**
     * @return integer | null
     */
    public function getConferenceRoomId()
    {
        if ($dto = $this->getConferenceRoom()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setLanguageId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return integer | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueDto $queue
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueDto $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueDto
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setQueueId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Queue\QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    /**
     * @return integer | null
     */
    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $externalCallFilter
     *
     * @return static
     */
    public function setExternalCallFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $externalCallFilter = null)
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto
     */
    public function getExternalCallFilter()
    {
        return $this->externalCallFilter;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setExternalCallFilterId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto($id)
            : null;

        return $this->setExternalCallFilter($value);
    }

    /**
     * @return integer | null
     */
    public function getExternalCallFilterId()
    {
        if ($dto = $this->getExternalCallFilter()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserDto $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return integer | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrDto $ivr
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrDto $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrDto
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setIvrId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ivr\IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    /**
     * @return integer | null
     */
    public function getIvrId()
    {
        if ($dto = $this->getIvr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto $huntGroup
     *
     * @return static
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setHuntGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto($id)
            : null;

        return $this->setHuntGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getHuntGroupId()
    {
        if ($dto = $this->getHuntGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxDto $fax
     *
     * @return static
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxDto $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxDto
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFaxId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Fax\FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    /**
     * @return integer | null
     */
    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDdiProviderId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return integer | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice
     *
     * @return static
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setResidentialDeviceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return integer | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto $conditionalRoute
     *
     * @return static
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setConditionalRouteId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto($id)
            : null;

        return $this->setConditionalRoute($value);
    }

    /**
     * @return integer | null
     */
    public function getConditionalRouteId()
    {
        if ($dto = $this->getConditionalRoute()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount
     *
     * @return static
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRetailAccountId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return integer | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
