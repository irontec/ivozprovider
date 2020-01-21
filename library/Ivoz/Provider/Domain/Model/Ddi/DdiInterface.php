<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface DdiInterface extends LoggableEntityInterface
{
    const RECORDCALLS_NONE = 'none';
    const RECORDCALLS_ALL = 'all';
    const RECORDCALLS_INBOUND = 'inbound';
    const RECORDCALLS_OUTBOUND = 'outbound';


    const ROUTETYPE_USER = 'user';
    const ROUTETYPE_IVR = 'ivr';
    const ROUTETYPE_HUNTGROUP = 'huntGroup';
    const ROUTETYPE_FAX = 'fax';
    const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';
    const ROUTETYPE_FRIEND = 'friend';
    const ROUTETYPE_QUEUE = 'queue';
    const ROUTETYPE_CONDITIONAL = 'conditional';
    const ROUTETYPE_RESIDENTIAL = 'residential';
    const ROUTETYPE_RETAIL = 'retail';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setDdi($ddi);

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    public function getLanguageCode();

    public function setRouteType($routeType = null);

    /**
     * @return string
     */
    public function getDdie164();

    /**
     * Get ddi
     *
     * @return string
     */
    public function getDdi();

    /**
     * Get recordCalls
     *
     * @return string
     */
    public function getRecordCalls();

    /**
     * Get displayName
     *
     * @return string | null
     */
    public function getDisplayName();

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType();

    /**
     * Get billInboundCalls
     *
     * @return boolean
     */
    public function getBillInboundCalls();

    /**
     * Get friendValue
     *
     * @return string | null
     */
    public function getFriendValue();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set conferenceRoom
     *
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom | null
     *
     * @return static
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null);

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface | null
     */
    public function getConferenceRoom();

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language | null
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null);

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue | null
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null);

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface | null
     */
    public function getQueue();

    /**
     * Set externalCallFilter
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter | null
     *
     * @return static
     */
    public function setExternalCallFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface $externalCallFilter = null);

    /**
     * Get externalCallFilter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    public function getExternalCallFilter();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser();

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr | null
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null);

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    public function getIvr();

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup | null
     *
     * @return static
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null);

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup();

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax | null
     *
     * @return static
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax = null);

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax();

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider | null
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null);

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider();

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country);

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry();

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice | null
     *
     * @return static
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null);

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice();

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute | null
     *
     * @return static
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null);

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface | null
     */
    public function getConditionalRoute();

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount | null
     *
     * @return static
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null);

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount();

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
