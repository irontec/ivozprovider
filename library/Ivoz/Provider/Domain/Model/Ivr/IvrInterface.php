<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

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

    public function getName(): string;

    public function getTimeout(): int;

    public function getMaxDigits(): int;

    public function getAllowExtensions(): bool;

    public function getNoInputRouteType(): ?string;

    public function getNoInputNumberValue(): ?string;

    public function getErrorRouteType(): ?string;

    public function getErrorNumberValue(): ?string;

    public function getCompany(): CompanyInterface;

    public function getWelcomeLocution(): ?LocutionInterface;

    public function getNoInputLocution(): ?LocutionInterface;

    public function getErrorLocution(): ?LocutionInterface;

    public function getSuccessLocution(): ?LocutionInterface;

    public function getNoInputExtension(): ?ExtensionInterface;

    public function getErrorExtension(): ?ExtensionInterface;

    public function getNoInputVoiceMailUser(): ?UserInterface;

    public function getErrorVoiceMailUser(): ?UserInterface;

    public function getNoInputNumberCountry(): ?CountryInterface;

    public function getErrorNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addEntry(IvrEntryInterface $entry): IvrInterface;

    public function removeEntry(IvrEntryInterface $entry): IvrInterface;

    public function replaceEntries(ArrayCollection $entries): IvrInterface;

    public function getEntries(?Criteria $criteria = null): array;

    public function addExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    public function removeExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    public function replaceExcludedExtensions(ArrayCollection $excludedExtensions): IvrInterface;

    public function getExcludedExtensions(?Criteria $criteria = null): array;

}
