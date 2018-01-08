<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface IvrInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return LocutionInterface[] with key=>value
     */
    public function getAllLocutions();

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoInputNumberValueE164();

    /**
     * Get the error numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getErrorNumberValueE164();

    public function getNoInputTarget();

    public function getErrorTarget();

    public function __toString();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set timeout
     *
     * @param integer $timeout
     *
     * @return self
     */
    public function setTimeout($timeout);

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout();

    /**
     * Set maxDigits
     *
     * @param integer $maxDigits
     *
     * @return self
     */
    public function setMaxDigits($maxDigits);

    /**
     * Get maxDigits
     *
     * @return integer
     */
    public function getMaxDigits();

    /**
     * Set allowExtensions
     *
     * @param boolean $allowExtensions
     *
     * @return self
     */
    public function setAllowExtensions($allowExtensions);

    /**
     * Get allowExtensions
     *
     * @return boolean
     */
    public function getAllowExtensions();

    /**
     * Set noInputRouteType
     *
     * @param string $noInputRouteType
     *
     * @return self
     */
    public function setNoInputRouteType($noInputRouteType = null);

    /**
     * Get noInputRouteType
     *
     * @return string
     */
    public function getNoInputRouteType();

    /**
     * Set noInputNumberValue
     *
     * @param string $noInputNumberValue
     *
     * @return self
     */
    public function setNoInputNumberValue($noInputNumberValue = null);

    /**
     * Get noInputNumberValue
     *
     * @return string
     */
    public function getNoInputNumberValue();

    /**
     * Set errorRouteType
     *
     * @param string $errorRouteType
     *
     * @return self
     */
    public function setErrorRouteType($errorRouteType = null);

    /**
     * Get errorRouteType
     *
     * @return string
     */
    public function getErrorRouteType();

    /**
     * Set errorNumberValue
     *
     * @param string $errorNumberValue
     *
     * @return self
     */
    public function setErrorNumberValue($errorNumberValue = null);

    /**
     * Get errorNumberValue
     *
     * @return string
     */
    public function getErrorNumberValue();

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
     * Set welcomeLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution
     *
     * @return self
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null);

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getWelcomeLocution();

    /**
     * Set noInputLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution
     *
     * @return self
     */
    public function setNoInputLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution = null);

    /**
     * Get noInputLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getNoInputLocution();

    /**
     * Set errorLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution
     *
     * @return self
     */
    public function setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution = null);

    /**
     * Get errorLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getErrorLocution();

    /**
     * Set successLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution
     *
     * @return self
     */
    public function setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution = null);

    /**
     * Get successLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getSuccessLocution();

    /**
     * Set noInputExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension
     *
     * @return self
     */
    public function setNoInputExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension = null);

    /**
     * Get noInputExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getNoInputExtension();

    /**
     * Set errorExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension
     *
     * @return self
     */
    public function setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension = null);

    /**
     * Get errorExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getErrorExtension();

    /**
     * Set noInputVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser
     *
     * @return self
     */
    public function setNoInputVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser = null);

    /**
     * Get noInputVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getNoInputVoiceMailUser();

    /**
     * Set errorVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser
     *
     * @return self
     */
    public function setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser = null);

    /**
     * Get errorVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getErrorVoiceMailUser();

    /**
     * Set noInputNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry
     *
     * @return self
     */
    public function setNoInputNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry = null);

    /**
     * Get noInputNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNoInputNumberCountry();

    /**
     * Set errorNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry
     *
     * @return self
     */
    public function setErrorNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry = null);

    /**
     * Get errorNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getErrorNumberCountry();

    /**
     * Add entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry
     *
     * @return IvrTrait
     */
    public function addEntry(\Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry);

    /**
     * Remove entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry
     */
    public function removeEntry(\Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry);

    /**
     * Replace entries
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface[] $entries
     * @return self
     */
    public function replaceEntries(Collection $entries);

    /**
     * Get entries
     *
     * @return array
     */
    public function getEntries(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add excludedExtension
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension
     *
     * @return IvrTrait
     */
    public function addExcludedExtension(\Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension);

    /**
     * Remove excludedExtension
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension
     */
    public function removeExcludedExtension(\Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension);

    /**
     * Replace excludedExtensions
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface[] $excludedExtensions
     * @return self
     */
    public function replaceExcludedExtensions(Collection $excludedExtensions);

    /**
     * Get excludedExtensions
     *
     * @return array
     */
    public function getExcludedExtensions(\Doctrine\Common\Collections\Criteria $criteria = null);

}

