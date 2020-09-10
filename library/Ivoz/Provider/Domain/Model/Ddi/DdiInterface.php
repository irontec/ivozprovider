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
    public function getDdie164(): string;

    /**
     * Get ddi
     *
     * @return string
     */
    public function getDdi(): string;

    /**
     * Get recordCalls
     *
     * @return string
     */
    public function getRecordCalls(): string;

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
    public function getBillInboundCalls(): bool;

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
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface | null
     */
    public function getConferenceRoom();

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface | null
     */
    public function getQueue();

    /**
     * Get externalCallFilter
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface | null
     */
    public function getExternalCallFilter();

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser();

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    public function getIvr();

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup();

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax();

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider();

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
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
