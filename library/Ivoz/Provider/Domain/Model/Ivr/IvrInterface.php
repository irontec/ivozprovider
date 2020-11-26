<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* IvrInterface
*/
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
    public function getName(): string;

    /**
     * Get timeout
     *
     * @return int
     */
    public function getTimeout(): int;

    /**
     * Get maxDigits
     *
     * @return int
     */
    public function getMaxDigits(): int;

    /**
     * Get allowExtensions
     *
     * @return bool
     */
    public function getAllowExtensions(): bool;

    /**
     * Get noInputRouteType
     *
     * @return string | null
     */
    public function getNoInputRouteType(): ?string;

    /**
     * Get noInputNumberValue
     *
     * @return string | null
     */
    public function getNoInputNumberValue(): ?string;

    /**
     * Get errorRouteType
     *
     * @return string | null
     */
    public function getErrorRouteType(): ?string;

    /**
     * Get errorNumberValue
     *
     * @return string | null
     */
    public function getErrorNumberValue(): ?string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get welcomeLocution
     *
     * @return LocutionInterface | null
     */
    public function getWelcomeLocution(): ?LocutionInterface;

    /**
     * Get noInputLocution
     *
     * @return LocutionInterface | null
     */
    public function getNoInputLocution(): ?LocutionInterface;

    /**
     * Get errorLocution
     *
     * @return LocutionInterface | null
     */
    public function getErrorLocution(): ?LocutionInterface;

    /**
     * Get successLocution
     *
     * @return LocutionInterface | null
     */
    public function getSuccessLocution(): ?LocutionInterface;

    /**
     * Get noInputExtension
     *
     * @return ExtensionInterface | null
     */
    public function getNoInputExtension(): ?ExtensionInterface;

    /**
     * Get errorExtension
     *
     * @return ExtensionInterface | null
     */
    public function getErrorExtension(): ?ExtensionInterface;

    /**
     * Get noInputVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getNoInputVoiceMailUser(): ?UserInterface;

    /**
     * Get errorVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getErrorVoiceMailUser(): ?UserInterface;

    /**
     * Get noInputNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getNoInputNumberCountry(): ?CountryInterface;

    /**
     * Get errorNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getErrorNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add entry
     *
     * @param IvrEntryInterface $entry
     *
     * @return static
     */
    public function addEntry(IvrEntryInterface $entry): IvrInterface;

    /**
     * Remove entry
     *
     * @param IvrEntryInterface $entry
     *
     * @return static
     */
    public function removeEntry(IvrEntryInterface $entry): IvrInterface;

    /**
     * Replace entries
     *
     * @param ArrayCollection $entries of IvrEntryInterface
     *
     * @return static
     */
    public function replaceEntries(ArrayCollection $entries): IvrInterface;

    /**
     * Get entries
     * @param Criteria | null $criteria
     * @return IvrEntryInterface[]
     */
    public function getEntries(?Criteria $criteria = null): array;

    /**
     * Add excludedExtension
     *
     * @param IvrExcludedExtensionInterface $excludedExtension
     *
     * @return static
     */
    public function addExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    /**
     * Remove excludedExtension
     *
     * @param IvrExcludedExtensionInterface $excludedExtension
     *
     * @return static
     */
    public function removeExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    /**
     * Replace excludedExtensions
     *
     * @param ArrayCollection $excludedExtensions of IvrExcludedExtensionInterface
     *
     * @return static
     */
    public function replaceExcludedExtensions(ArrayCollection $excludedExtensions): IvrInterface;

    /**
     * Get excludedExtensions
     * @param Criteria | null $criteria
     * @return IvrExcludedExtensionInterface[]
     */
    public function getExcludedExtensions(?Criteria $criteria = null): array;

}
