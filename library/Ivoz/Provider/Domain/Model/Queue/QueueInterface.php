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
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164();

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164();

    public function setMaxWaitTime($maxWaitTime = null);

    public function setMaxlen($maxlen = null);

    public function __toString();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get maxWaitTime
     *
     * @return integer
     */
    public function getMaxWaitTime();

    /**
     * Set timeoutTargetType
     *
     * @param string $timeoutTargetType
     *
     * @return self
     */
    public function setTimeoutTargetType($timeoutTargetType = null);

    /**
     * Get timeoutTargetType
     *
     * @return string
     */
    public function getTimeoutTargetType();

    /**
     * Set timeoutNumberValue
     *
     * @param string $timeoutNumberValue
     *
     * @return self
     */
    public function setTimeoutNumberValue($timeoutNumberValue = null);

    /**
     * Get timeoutNumberValue
     *
     * @return string
     */
    public function getTimeoutNumberValue();

    /**
     * Get maxlen
     *
     * @return integer
     */
    public function getMaxlen();

    /**
     * Set fullTargetType
     *
     * @param string $fullTargetType
     *
     * @return self
     */
    public function setFullTargetType($fullTargetType = null);

    /**
     * Get fullTargetType
     *
     * @return string
     */
    public function getFullTargetType();

    /**
     * Set fullNumberValue
     *
     * @param string $fullNumberValue
     *
     * @return self
     */
    public function setFullNumberValue($fullNumberValue = null);

    /**
     * Get fullNumberValue
     *
     * @return string
     */
    public function getFullNumberValue();

    /**
     * Set periodicAnnounceFrequency
     *
     * @param integer $periodicAnnounceFrequency
     *
     * @return self
     */
    public function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null);

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer
     */
    public function getPeriodicAnnounceFrequency();

    /**
     * Set memberCallRest
     *
     * @param integer $memberCallRest
     *
     * @return self
     */
    public function setMemberCallRest($memberCallRest = null);

    /**
     * Get memberCallRest
     *
     * @return integer
     */
    public function getMemberCallRest();

    /**
     * Set memberCallTimeout
     *
     * @param integer $memberCallTimeout
     *
     * @return self
     */
    public function setMemberCallTimeout($memberCallTimeout = null);

    /**
     * Get memberCallTimeout
     *
     * @return integer
     */
    public function getMemberCallTimeout();

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    public function setStrategy($strategy = null);

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight = null);

    /**
     * Get weight
     *
     * @return integer
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

}

