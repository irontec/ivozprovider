<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

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
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DdiInterface
*/
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
    public function setDdi(string $ddi): DdiInterface;

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    public function getLanguageCode();

    public function setRouteType(string $routeType = null): DdiInterface;

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
    public function getDisplayName(): ?string;

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType(): ?string;

    /**
     * Get billInboundCalls
     *
     * @return bool
     */
    public function getBillInboundCalls(): bool;

    /**
     * Get friendValue
     *
     * @return string | null
     */
    public function getFriendValue(): ?string;

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): DdiInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get conferenceRoom
     *
     * @return ConferenceRoomInterface | null
     */
    public function getConferenceRoom(): ?ConferenceRoomInterface;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * Get queue
     *
     * @return QueueInterface | null
     */
    public function getQueue(): ?QueueInterface;

    /**
     * Get externalCallFilter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getExternalCallFilter(): ?ExternalCallFilterInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get ivr
     *
     * @return IvrInterface | null
     */
    public function getIvr(): ?IvrInterface;

    /**
     * Get huntGroup
     *
     * @return HuntGroupInterface | null
     */
    public function getHuntGroup(): ?HuntGroupInterface;

    /**
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface;

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface;

    /**
     * Get country
     *
     * @return CountryInterface
     */
    public function getCountry(): CountryInterface;

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): DdiInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface | null
     */
    public function getConditionalRoute(): ?ConditionalRouteInterface;

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): DdiInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface;

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
