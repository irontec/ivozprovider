<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    const TIMEOUTTARGETTYPE_NUMBER = 'number';

    const TIMEOUTTARGETTYPE_EXTENSION = 'extension';

    const TIMEOUTTARGETTYPE_VOICEMAIL = 'voicemail';

    const FULLTARGETTYPE_NUMBER = 'number';

    const FULLTARGETTYPE_EXTENSION = 'extension';

    const FULLTARGETTYPE_VOICEMAIL = 'voicemail';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setName(?string $name = null): static;

    public function getAstQueueName();

    /**
     * @return string
     */
    public function getTimeoutRouteType();

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164();

    /**
     * @return string
     */
    public function getFullRouteType();

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164();

    public function setMaxWaitTime(?int $maxWaitTime = null): static;

    public function setMaxlen(?int $maxlen = null): static;

    public function getName(): ?string;

    public function getMaxWaitTime(): ?int;

    public function getTimeoutTargetType(): ?string;

    public function getTimeoutNumberValue(): ?string;

    public function getMaxlen(): ?int;

    public function getFullTargetType(): ?string;

    public function getFullNumberValue(): ?string;

    public function getPeriodicAnnounceFrequency(): ?int;

    public function getMemberCallRest(): ?int;

    public function getMemberCallTimeout(): ?int;

    public function getStrategy(): ?string;

    public function getWeight(): ?int;

    public function getPreventMissedCalls(): int;

    public function getCompany(): CompanyInterface;

    public function getPeriodicAnnounceLocution(): ?LocutionInterface;

    public function getTimeoutLocution(): ?LocutionInterface;

    public function getTimeoutExtension(): ?ExtensionInterface;

    public function getTimeoutVoiceMailUser(): ?UserInterface;

    public function getFullLocution(): ?LocutionInterface;

    public function getFullExtension(): ?ExtensionInterface;

    public function getFullVoiceMailUser(): ?UserInterface;

    public function getTimeoutNumberCountry(): ?CountryInterface;

    public function getFullNumberCountry(): ?CountryInterface;

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
