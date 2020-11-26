<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    const TIMEOUTTARGETTYPE_NUMBER = 'number';

    const TIMEOUTTARGETTYPE_EXTENSION = 'extension';

    const TIMEOUTTARGETTYPE_VOICEMAIL = 'voicemail';

    const FULLTARGETTYPE_NUMBER = 'number';

    const FULLTARGETTYPE_EXTENSION = 'extension';

    const FULLTARGETTYPE_VOICEMAIL = 'voicemail';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setName(string $name = null): QueueInterface;

    public function getAstQueueName();

    /**
     * @return string
     */
    public function getTimeoutRouteType();

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164();

    /**
     * @return string
     */
    public function getFullRouteType();

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164();

    public function setMaxWaitTime(int $maxWaitTime = null): QueueInterface;

    public function setMaxlen(int $maxlen = null): QueueInterface;

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * Get maxWaitTime
     *
     * @return int | null
     */
    public function getMaxWaitTime(): ?int;

    /**
     * Get timeoutTargetType
     *
     * @return string | null
     */
    public function getTimeoutTargetType(): ?string;

    /**
     * Get timeoutNumberValue
     *
     * @return string | null
     */
    public function getTimeoutNumberValue(): ?string;

    /**
     * Get maxlen
     *
     * @return int | null
     */
    public function getMaxlen(): ?int;

    /**
     * Get fullTargetType
     *
     * @return string | null
     */
    public function getFullTargetType(): ?string;

    /**
     * Get fullNumberValue
     *
     * @return string | null
     */
    public function getFullNumberValue(): ?string;

    /**
     * Get periodicAnnounceFrequency
     *
     * @return int | null
     */
    public function getPeriodicAnnounceFrequency(): ?int;

    /**
     * Get memberCallRest
     *
     * @return int | null
     */
    public function getMemberCallRest(): ?int;

    /**
     * Get memberCallTimeout
     *
     * @return int | null
     */
    public function getMemberCallTimeout(): ?int;

    /**
     * Get strategy
     *
     * @return string | null
     */
    public function getStrategy(): ?string;

    /**
     * Get weight
     *
     * @return int | null
     */
    public function getWeight(): ?int;

    /**
     * Get preventMissedCalls
     *
     * @return int
     */
    public function getPreventMissedCalls(): int;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get periodicAnnounceLocution
     *
     * @return LocutionInterface | null
     */
    public function getPeriodicAnnounceLocution(): ?LocutionInterface;

    /**
     * Get timeoutLocution
     *
     * @return LocutionInterface | null
     */
    public function getTimeoutLocution(): ?LocutionInterface;

    /**
     * Get timeoutExtension
     *
     * @return ExtensionInterface | null
     */
    public function getTimeoutExtension(): ?ExtensionInterface;

    /**
     * Get timeoutVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getTimeoutVoiceMailUser(): ?UserInterface;

    /**
     * Get fullLocution
     *
     * @return LocutionInterface | null
     */
    public function getFullLocution(): ?LocutionInterface;

    /**
     * Get fullExtension
     *
     * @return ExtensionInterface | null
     */
    public function getFullExtension(): ?ExtensionInterface;

    /**
     * Get fullVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getFullVoiceMailUser(): ?UserInterface;

    /**
     * Get timeoutNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getTimeoutNumberCountry(): ?CountryInterface;

    /**
     * Get fullNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getFullNumberCountry(): ?CountryInterface;

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
