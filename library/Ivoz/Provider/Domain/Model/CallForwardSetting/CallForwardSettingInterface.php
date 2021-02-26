<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
* CallForwardSettingInterface
*/
interface CallForwardSettingInterface extends LoggableEntityInterface
{
    const CALLTYPEFILTER_INTERNAL = 'internal';

    const CALLTYPEFILTER_EXTERNAL = 'external';

    const CALLTYPEFILTER_BOTH = 'both';

    const CALLFORWARDTYPE_INCONDITIONAL = 'inconditional';

    const CALLFORWARDTYPE_NOANSWER = 'noAnswer';

    const CALLFORWARDTYPE_BUSY = 'busy';

    const CALLFORWARDTYPE_USERNOTREGISTERED = 'userNotRegistered';

    const TARGETTYPE_NUMBER = 'number';

    const TARGETTYPE_EXTENSION = 'extension';

    const TARGETTYPE_VOICEMAIL = 'voicemail';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     *
     * @throws \InvalidArgumentException
     */
    public function setNumberValue(?string $numberValue = null): static;

    public function toArrayPortal();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Alias for getTargetType
     *
     * @todo rename tagetType field to routeType
     */
    public function getRouteType();

    public function getCallTypeFilter(): string;

    public function getCallForwardType(): string;

    public function getTargetType(): ?string;

    public function getNumberValue(): ?string;

    public function getNoAnswerTimeout(): int;

    public function getEnabled(): bool;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoiceMailUser(): ?UserInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static;

    public function getRetailAccount(): ?RetailAccountInterface;

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
