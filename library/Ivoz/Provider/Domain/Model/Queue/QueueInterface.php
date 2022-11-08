<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setName($name = null);

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

    public function setMaxWaitTime($maxWaitTime = null);

    public function setMaxlen($maxlen = null);

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName();

    /**
     * Get displayName
     *
     * @return string | null
     */
    public function getDisplayName();

    /**
     * Get maxWaitTime
     *
     * @return integer | null
     */
    public function getMaxWaitTime();

    /**
     * Get timeoutTargetType
     *
     * @return string | null
     */
    public function getTimeoutTargetType();

    /**
     * Get timeoutNumberValue
     *
     * @return string | null
     */
    public function getTimeoutNumberValue();

    /**
     * Get maxlen
     *
     * @return integer | null
     */
    public function getMaxlen();

    /**
     * Get fullTargetType
     *
     * @return string | null
     */
    public function getFullTargetType();

    /**
     * Get fullNumberValue
     *
     * @return string | null
     */
    public function getFullNumberValue();

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer | null
     */
    public function getPeriodicAnnounceFrequency();

    /**
     * Get memberCallRest
     *
     * @return integer | null
     */
    public function getMemberCallRest();

    /**
     * Get memberCallTimeout
     *
     * @return integer | null
     */
    public function getMemberCallTimeout();

    /**
     * Get strategy
     *
     * @return string | null
     */
    public function getStrategy();

    /**
     * Get weight
     *
     * @return integer | null
     */
    public function getWeight();

    /**
     * Get preventMissedCalls
     *
     * @return integer
     */
    public function getPreventMissedCalls(): int;

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get periodicAnnounceLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getPeriodicAnnounceLocution();

    /**
     * Get timeoutLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getTimeoutLocution();

    /**
     * Get timeoutExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getTimeoutExtension();

    /**
     * Get timeoutVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getTimeoutVoiceMailUser();

    /**
     * Get fullLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getFullLocution();

    /**
     * Get fullExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getFullExtension();

    /**
     * Get fullVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getFullVoiceMailUser();

    /**
     * Get timeoutNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getTimeoutNumberCountry();

    /**
     * Get fullNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getFullNumberCountry();

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
