<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ResidentialDeviceInterface
*/
interface ResidentialDeviceInterface extends LoggableEntityInterface
{
    const TRANSPORT_UDP = 'udp';

    const TRANSPORT_TCP = 'tcp';

    const TRANSPORT_TLS = 'tls';

    const DIRECTMEDIAMETHOD_INVITE = 'invite';

    const DIRECTMEDIAMETHOD_UPDATE = 'update';

    const CALLERIDUPDATEHEADER_PAI = 'pai';

    const CALLERIDUPDATEHEADER_RPID = 'rpid';

    const UPDATECALLERID_YES = 'yes';

    const UPDATECALLERID_NO = 'no';

    const DIRECTCONNECTIVITY_YES = 'yes';

    const DIRECTCONNECTIVITY_NO = 'no';

    const DDIIN_YES = 'yes';

    const DDIIN_NO = 'no';

    const T38PASSTHROUGH_YES = 'yes';

    const T38PASSTHROUGH_NO = 'no';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return bool
     */
    public function isDirectConnectivity(): bool;

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): ResidentialDeviceInterface;

    /**
     * {@inheritDoc}
     */
    public function setIp(string $ip = null): ResidentialDeviceInterface;

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password = null): ResidentialDeviceInterface;

    public function setPort(int $port = null): ResidentialDeviceInterface;

    /**
     * @return string
     */
    public function getContact();

    /**
     * @return string
     */
    public function getSorcery();

    /**
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface|mixed
     */
    public function getAstPsEndpoint();

    /**
     * @return string
     */
    public function getLanguageCode();

    /**
     * @return string | null
     */
    public function getOutgoingDdiNumber();

    /**
     * Get Residential Device outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | NULL
     */
    public function getOutgoingDdi(): ?DdiInterface;

    /**
     * Get Ddi associated with this residential device
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getDdi($ddieE164);

    /**
     * @return string with the voicemail
     */
    public function getVoiceMail();

    /**
     * @return string with the voicemail user
     */
    public function getVoiceMailUser();

    /**
     * @return string with the voicemail context
     */
    public function getVoiceMailContext();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get transport
     *
     * @return string | null
     */
    public function getTransport(): ?string;

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * Get port
     *
     * @return int | null
     */
    public function getPort(): ?int;

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded(): string;

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string;

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string;

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow(): string;

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod(): string;

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader(): string;

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid(): string;

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string;

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity(): string;

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn(): string;

    /**
     * Get maxCalls
     *
     * @return int
     */
    public function getMaxCalls(): int;

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough(): string;

    /**
     * Get rtpEncryption
     *
     * @return bool
     */
    public function getRtpEncryption(): bool;

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): ResidentialDeviceInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Set domain
     *
     * @param DomainInterface | null
     *
     * @return static
     */
    public function setDomain(?DomainInterface $domain = null): ResidentialDeviceInterface;

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(PsEndpointInterface $psEndpoint): ResidentialDeviceInterface;

    /**
     * Remove psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function removePsEndpoint(PsEndpointInterface $psEndpoint): ResidentialDeviceInterface;

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints): ResidentialDeviceInterface;

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getPsEndpoints(?Criteria $criteria = null): array;

    /**
     * Add ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function addDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    /**
     * Remove ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function removeDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    /**
     * Replace ddis
     *
     * @param ArrayCollection $ddis of DdiInterface
     *
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis): ResidentialDeviceInterface;

    /**
     * Get ddis
     * @param Criteria | null $criteria
     * @return DdiInterface[]
     */
    public function getDdis(?Criteria $criteria = null): array;

    /**
     * Add callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    /**
     * Remove callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of CallForwardSettingInterface
     *
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): ResidentialDeviceInterface;

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(?Criteria $criteria = null): array;

}
