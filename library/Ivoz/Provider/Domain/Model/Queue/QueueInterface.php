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
     * Set periodicAnnounceLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution | null
     *
     * @return static
     */
    public function setPeriodicAnnounceLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution = null);

    /**
     * Get periodicAnnounceLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getPeriodicAnnounceLocution();

    /**
     * Set timeoutLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution | null
     *
     * @return static
     */
    public function setTimeoutLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution = null);

    /**
     * Get timeoutLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getTimeoutLocution();

    /**
     * Set timeoutExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension | null
     *
     * @return static
     */
    public function setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension = null);

    /**
     * Get timeoutExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getTimeoutExtension();

    /**
     * Set timeoutVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser | null
     *
     * @return static
     */
    public function setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser = null);

    /**
     * Get timeoutVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getTimeoutVoiceMailUser();

    /**
     * Set fullLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution | null
     *
     * @return static
     */
    public function setFullLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution = null);

    /**
     * Get fullLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getFullLocution();

    /**
     * Set fullExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension | null
     *
     * @return static
     */
    public function setFullExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension = null);

    /**
     * Get fullExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getFullExtension();

    /**
     * Set fullVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser | null
     *
     * @return static
     */
    public function setFullVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser = null);

    /**
     * Get fullVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getFullVoiceMailUser();

    /**
     * Set timeoutNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry | null
     *
     * @return static
     */
    public function setTimeoutNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry = null);

    /**
     * Get timeoutNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getTimeoutNumberCountry();

    /**
     * Set fullNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry | null
     *
     * @return static
     */
    public function setFullNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry = null);

    /**
     * Get fullNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getFullNumberCountry();

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
