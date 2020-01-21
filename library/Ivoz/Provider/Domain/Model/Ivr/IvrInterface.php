<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface IvrInterface extends LoggableEntityInterface
{
    const NOINPUTROUTETYPE_NUMBER = 'number';
    const NOINPUTROUTETYPE_EXTENSION = 'extension';
    const NOINPUTROUTETYPE_VOICEMAIL = 'voicemail';


    const ERRORROUTETYPE_NUMBER = 'number';
    const ERRORROUTETYPE_EXTENSION = 'extension';
    const ERRORROUTETYPE_VOICEMAIL = 'voicemail';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface[] with key=>value
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

    /**
     * @return null|string
     */
    public function getNoInputTarget();

    /**
     * @return null|string
     */
    public function getErrorTarget();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout();

    /**
     * Get maxDigits
     *
     * @return integer
     */
    public function getMaxDigits();

    /**
     * Get allowExtensions
     *
     * @return boolean
     */
    public function getAllowExtensions();

    /**
     * Get noInputRouteType
     *
     * @return string | null
     */
    public function getNoInputRouteType();

    /**
     * Get noInputNumberValue
     *
     * @return string | null
     */
    public function getNoInputNumberValue();

    /**
     * Get errorRouteType
     *
     * @return string | null
     */
    public function getErrorRouteType();

    /**
     * Get errorNumberValue
     *
     * @return string | null
     */
    public function getErrorNumberValue();

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
     * Set welcomeLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution | null
     *
     * @return static
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null);

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getWelcomeLocution();

    /**
     * Set noInputLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution | null
     *
     * @return static
     */
    public function setNoInputLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noInputLocution = null);

    /**
     * Get noInputLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getNoInputLocution();

    /**
     * Set errorLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution | null
     *
     * @return static
     */
    public function setErrorLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $errorLocution = null);

    /**
     * Get errorLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getErrorLocution();

    /**
     * Set successLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution | null
     *
     * @return static
     */
    public function setSuccessLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $successLocution = null);

    /**
     * Get successLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getSuccessLocution();

    /**
     * Set noInputExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension | null
     *
     * @return static
     */
    public function setNoInputExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noInputExtension = null);

    /**
     * Get noInputExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getNoInputExtension();

    /**
     * Set errorExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension | null
     *
     * @return static
     */
    public function setErrorExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $errorExtension = null);

    /**
     * Get errorExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getErrorExtension();

    /**
     * Set noInputVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser | null
     *
     * @return static
     */
    public function setNoInputVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noInputVoiceMailUser = null);

    /**
     * Get noInputVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getNoInputVoiceMailUser();

    /**
     * Set errorVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser | null
     *
     * @return static
     */
    public function setErrorVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $errorVoiceMailUser = null);

    /**
     * Get errorVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getErrorVoiceMailUser();

    /**
     * Set noInputNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry | null
     *
     * @return static
     */
    public function setNoInputNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $noInputNumberCountry = null);

    /**
     * Get noInputNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNoInputNumberCountry();

    /**
     * Set errorNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry | null
     *
     * @return static
     */
    public function setErrorNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $errorNumberCountry = null);

    /**
     * Get errorNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getErrorNumberCountry();

    /**
     * Add entry
     *
     * @param \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface $entry
     *
     * @return static
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
     * @param ArrayCollection $entries of Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface
     * @return static
     */
    public function replaceEntries(ArrayCollection $entries);

    /**
     * Get entries
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface[]
     */
    public function getEntries(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add excludedExtension
     *
     * @param \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface $excludedExtension
     *
     * @return static
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
     * @param ArrayCollection $excludedExtensions of Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface
     * @return static
     */
    public function replaceExcludedExtensions(ArrayCollection $excludedExtensions);

    /**
     * Get excludedExtensions
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface[]
     */
    public function getExcludedExtensions(\Doctrine\Common\Collections\Criteria $criteria = null);
}
