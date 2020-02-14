<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getEntry();

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType();

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue();

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr);

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    public function getIvr();

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getWelcomeLocution();

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension();

    /**
     * Get voiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getVoiceMailUser();

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface | null
     */
    public function getConditionalRoute();

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNumberCountry();

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
