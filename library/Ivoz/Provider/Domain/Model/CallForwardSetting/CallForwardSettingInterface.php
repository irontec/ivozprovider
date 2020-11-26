<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setNumberValue(string $numberValue = null): CallForwardSettingInterface;

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

    /**
     * Get callTypeFilter
     *
     * @return string
     */
    public function getCallTypeFilter(): string;

    /**
     * Get callForwardType
     *
     * @return string
     */
    public function getCallForwardType(): string;

    /**
     * Get targetType
     *
     * @return string | null
     */
    public function getTargetType(): ?string;

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string;

    /**
     * Get noAnswerTimeout
     *
     * @return int
     */
    public function getNoAnswerTimeout(): int;

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled(): bool;

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    public function setUser(?UserInterface $user = null): CallForwardSettingInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

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
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface;

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): CallForwardSettingInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): CallForwardSettingInterface;

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
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
