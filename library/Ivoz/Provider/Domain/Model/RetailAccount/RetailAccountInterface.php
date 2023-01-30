<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* RetailAccountInterface
*/
interface RetailAccountInterface extends LoggableEntityInterface
{
    public const TRANSPORT_UDP = 'udp';

    public const TRANSPORT_TCP = 'tcp';

    public const TRANSPORT_TLS = 'tls';

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
    public function getSorcery(): string;

    /**
     * Get Ddi associated with this retail Account
     *
     * @param string $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi($ddieE164);

    public static function createDto(string|int|null $id = null): RetailAccountDto;

    /**
     * @internal use EntityTools instead
     * @param null|RetailAccountInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RetailAccountDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RetailAccountDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RetailAccountDto;

    public function getName(): string;

    public function getDescription(): string;

    public function getTransport(): ?string;

    public function getIp(): ?string;

    public function getPort(): ?int;

    public function getPassword(): ?string;

    public function getFromDomain(): ?string;

    public function getDirectConnectivity(): string;

    public function getDdiIn(): string;

    public function getT38Passthrough(): string;

    public function getRtpEncryption(): bool;

    public function getMultiContact(): bool;

    public function setBrand(BrandInterface $brand): static;

    public function getBrand(): BrandInterface;

    public function setDomain(?DomainInterface $domain = null): static;

    public function getDomain(): ?DomainInterface;

    public function getCompany(): CompanyInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getOutgoingDdi(): ?DdiInterface;

    public function setPsEndpoint(PsEndpointInterface $psEndpoint): static;

    public function getPsEndpoint(): ?PsEndpointInterface;

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static;

    public function getPsIdentify(): ?PsIdentifyInterface;

    public function addDdi(DdiInterface $ddi): RetailAccountInterface;

    public function removeDdi(DdiInterface $ddi): RetailAccountInterface;

    /**
     * @param Collection<array-key, DdiInterface> $ddis
     */
    public function replaceDdis(Collection $ddis): RetailAccountInterface;

    /**
     * @return array<array-key, DdiInterface>
     */
    public function getDdis(?Criteria $criteria = null): array;

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): RetailAccountInterface;

    /**
     * @return array<array-key, CallForwardSettingInterface>
     */
    public function getCallForwardSettings(?Criteria $criteria = null): array;
}
