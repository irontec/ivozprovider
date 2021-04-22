<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

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

    public function getEntry(): string;

    public function getRouteType(): string;

    public function getNumberValue(): ?string;

    public function setIvr(IvrInterface $ivr): static;

    public function getIvr(): IvrInterface;

    public function getWelcomeLocution(): ?LocutionInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoiceMailUser(): ?UserInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
