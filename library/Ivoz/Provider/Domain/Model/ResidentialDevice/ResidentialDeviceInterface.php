<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* ResidentialDeviceInterface
*/
interface ResidentialDeviceInterface extends LoggableEntityInterface
{
    public const TRANSPORT_UDP = 'udp';

    public const TRANSPORT_TCP = 'tcp';

    public const TRANSPORT_TLS = 'tls';

    public const DIRECTMEDIAMETHOD_INVITE = 'invite';

    public const DIRECTMEDIAMETHOD_UPDATE = 'update';

    public const CALLERIDUPDATEHEADER_PAI = 'pai';

    public const CALLERIDUPDATEHEADER_RPID = 'rpid';

    public const UPDATECALLERID_YES = 'yes';

    public const UPDATECALLERID_NO = 'no';

    public const DIRECTCONNECTIVITY_YES = 'yes';

    public const DIRECTCONNECTIVITY_NO = 'no';

    public const DDIIN_YES = 'yes';

    public const DDIIN_NO = 'no';

    public const T38PASSTHROUGH_YES = 'yes';

    public const T38PASSTHROUGH_NO = 'no';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

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
    public function getContact(): string;

    /**
     * @return string
     */
    public function getSorcery(): string;

    /**
     * @return string
     */
    public function getLanguageCode(): string;

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

    public static function createDto(string|int|null $id = null): ResidentialDeviceDto;

    /**
     * @internal use EntityTools instead
     * @param null|ResidentialDeviceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ResidentialDeviceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ResidentialDeviceDto;

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

    public function setVoicemail(VoicemailInterface $voicemail): static;

    public function getVoicemail(): ?VoicemailInterface;

    public function setPsEndpoint(PsEndpointInterface $psEndpoint): static;

    public function getPsEndpoint(): ?PsEndpointInterface;

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static;

    public function getPsIdentify(): ?PsIdentifyInterface;

    public function addDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    public function removeDdi(DdiInterface $ddi): ResidentialDeviceInterface;

    /**
     * @param Collection<array-key, DdiInterface> $ddis
     */
    public function replaceDdis(Collection $ddis): ResidentialDeviceInterface;

    public function getDdis(?Criteria $criteria = null): array;

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): ResidentialDeviceInterface;

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): ResidentialDeviceInterface;

    public function getCallForwardSettings(?Criteria $criteria = null): array;
}
