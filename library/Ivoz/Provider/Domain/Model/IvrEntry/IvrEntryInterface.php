<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* IvrEntryInterface
*/
interface IvrEntryInterface extends LoggableEntityInterface
{
    const ROUTETYPE_NUMBER = 'number';

    const ROUTETYPE_EXTENSION = 'extension';

    const ROUTETYPE_VOICEMAIL = 'voicemail';

    const ROUTETYPE_CONDITIONAL = 'conditional';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Get entry
     *
     * @return string
     */
    public function getEntry(): string;

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType(): string;

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string;

    /**
     * Set ivr
     *
     * @param IvrInterface
     *
     * @return static
     */
    public function setIvr(IvrInterface $ivr): IvrEntryInterface;

    /**
     * Get ivr
     *
     * @return IvrInterface
     */
    public function getIvr(): IvrInterface;

    /**
     * Get welcomeLocution
     *
     * @return LocutionInterface | null
     */
    public function getWelcomeLocution(): ?LocutionInterface;

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface;

    /**
     * Get voiceMailUser
     *
     * @return UserInterface | null
     */
    public function getVoiceMailUser(): ?UserInterface;

    /**
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface | null
     */
    public function getConditionalRoute(): ?ConditionalRouteInterface;

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface;

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
