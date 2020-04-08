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
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getWelcomeLocution();

    /**
     * Get noInputLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getNoInputLocution();

    /**
     * Get errorLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getErrorLocution();

    /**
     * Get successLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getSuccessLocution();

    /**
     * Get noInputExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getNoInputExtension();

    /**
     * Get errorExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getErrorExtension();

    /**
     * Get noInputVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getNoInputVoiceMailUser();

    /**
     * Get errorVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getErrorVoiceMailUser();

    /**
     * Get noInputNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNoInputNumberCountry();

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
