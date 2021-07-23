<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

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
    public function setName(string $name): static;

    /**
     * {@inheritDoc}
     */
    public function setIp(?string $ip = null): static;

    /**
     * {@inheritDoc}
     */
    public function setPassword(?string $password = null): static;

    public function setPort(?int $port = null): static;

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

    public function getName(): string;

    public function getDescription(): string;

    public function getTransport(): ?string;

    public function getIp(): ?string;

    public function getPort(): ?int;

    public function getAuthNeeded(): string;

    public function getPassword(): ?string;

    public function getDisallow(): string;

    public function getAllow(): string;

    public function getDirectMediaMethod(): string;

    public function getCalleridUpdateHeader(): string;

    public function getUpdateCallerid(): string;

    public function getFromDomain(): ?string;

    public function getDirectConnectivity(): string;

    public function getDdiIn(): string;

    public function getMaxCalls(): int;

    public function getT38Passthrough(): string;

    public function getRtpEncryption(): bool;

    public function getMultiContact(): bool;

    public function setBrand(BrandInterface $brand): static;

    public function getBrand(): BrandInterface;

    public function setDomain(?DomainInterface $domain = null): static;

    public function getDomain(): ?DomainInterface;

    public function getCompany(): CompanyInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getLanguage(): ?LanguageInterface;

    public function isInitialized(): bool;

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static;

    public function getPsIdentify(): ?PsIdentifyInterface;

    public function addPsEndpoint(PsEndpointInterface $psEndpoint): ResidentialDeviceInterface;

    public function removePsEndpoint(PsEndpointInterface $psEndpoint): ResidentialDeviceInterface;

    public function replacePsEndpoints(ArrayCollection $psEndpoints): ResidentialDeviceInterface;

    public function getPsEndpoints(?Criteria $criteria = null): array;

    public function addDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    public function removeDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    public function replaceDdis(ArrayCollection $ddis): ResidentialDeviceInterface;

    public function getDdis(?Criteria $criteria = null): array;

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): ResidentialDeviceInterface;

    public function getCallForwardSettings(?Criteria $criteria = null): array;
}
