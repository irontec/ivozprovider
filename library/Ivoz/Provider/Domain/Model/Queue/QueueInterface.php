<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface QueueInterface extends LoggableEntityInterface
{
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
     * @return self
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
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution
     *
     * @return self
     */
    public function setPeriodicAnnounceLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $periodicAnnounceLocution = null);

    /**
     * Get periodicAnnounceLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getPeriodicAnnounceLocution();

    /**
     * Set timeoutLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution
     *
     * @return self
     */
    public function setTimeoutLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $timeoutLocution = null);

    /**
     * Get timeoutLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getTimeoutLocution();

    /**
     * Set timeoutExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension
     *
     * @return self
     */
    public function setTimeoutExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $timeoutExtension = null);

    /**
     * Get timeoutExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getTimeoutExtension();

    /**
     * Set timeoutVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser
     *
     * @return self
     */
    public function setTimeoutVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $timeoutVoiceMailUser = null);

    /**
     * Get timeoutVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getTimeoutVoiceMailUser();

    /**
     * Set fullLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution
     *
     * @return self
     */
    public function setFullLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $fullLocution = null);

    /**
     * Get fullLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getFullLocution();

    /**
     * Set fullExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension
     *
     * @return self
     */
    public function setFullExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $fullExtension = null);

    /**
     * Get fullExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getFullExtension();

    /**
     * Set fullVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser
     *
     * @return self
     */
    public function setFullVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $fullVoiceMailUser = null);

    /**
     * Get fullVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getFullVoiceMailUser();

    /**
     * Set timeoutNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry
     *
     * @return self
     */
    public function setTimeoutNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $timeoutNumberCountry = null);

    /**
     * Get timeoutNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getTimeoutNumberCountry();

    /**
     * Set fullNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry
     *
     * @return self
     */
    public function setFullNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $fullNumberCountry = null);

    /**
     * Get fullNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getFullNumberCountry();

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
