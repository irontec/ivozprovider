<?php

namespace Ivoz\Provider\Domain\Model\IvrCustomEntry;

use Ivoz\Core\Domain\Model\EntityInterface;

interface IvrCustomEntryInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Set entry
     *
     * @param string $entry
     *
     * @return self
     */
    public function setEntry($entry);

    /**
     * Get entry
     *
     * @return string
     */
    public function getEntry();

    /**
     * Set targetType
     *
     * @param string $targetType
     *
     * @return self
     */
    public function setTargetType($targetType);

    /**
     * Get targetType
     *
     * @return string
     */
    public function getTargetType();

    /**
     * Set targetNumberValue
     *
     * @param string $targetNumberValue
     *
     * @return self
     */
    public function setTargetNumberValue($targetNumberValue = null);

    /**
     * Get targetNumberValue
     *
     * @return string
     */
    public function getTargetNumberValue();

    /**
     * Set ivrCustom
     *
     * @param \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface $ivrCustom
     *
     * @return self
     */
    public function setIvrCustom(\Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface $ivrCustom);

    /**
     * Get ivrCustom
     *
     * @return \Ivoz\Provider\Domain\Model\IvrCustom\IvrCustomInterface
     */
    public function getIvrCustom();

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
     * Set targetExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $targetExtension
     *
     * @return self
     */
    public function setTargetExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $targetExtension = null);

    /**
     * Get targetExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getTargetExtension();

    /**
     * Set targetVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $targetVoiceMailUser
     *
     * @return self
     */
    public function setTargetVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $targetVoiceMailUser = null);

    /**
     * Get targetVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getTargetVoiceMailUser();

    /**
     * Set targetConditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $targetConditionalRoute
     *
     * @return self
     */
    public function setTargetConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $targetConditionalRoute = null);

    /**
     * Get targetConditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    public function getTargetConditionalRoute();

}

