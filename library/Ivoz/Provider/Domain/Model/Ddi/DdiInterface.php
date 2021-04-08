<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
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
    public function setDdi(string $ddi): static;

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    public function getLanguageCode();

    public function setRouteType(?string $routeType = null): static;

    /**
     * @return string
     */
    public function getDdie164(): string;

    public function getDdi(): string;

    public function getRecordCalls(): string;

    public function getDisplayName(): ?string;

    public function getRouteType(): ?string;

    public function getBillInboundCalls(): bool;

    public function getFriendValue(): ?string;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getBrand(): BrandInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getLanguage(): ?LanguageInterface;

    public function getQueue(): ?QueueInterface;

    public function getExternalCallFilter(): ?ExternalCallFilterInterface;

    public function getUser(): ?UserInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getFax(): ?FaxInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    public function getCountry(): ?CountryInterface;

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static;

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
