<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* RetailAccountInterface
*/
interface RetailAccountInterface extends LoggableEntityInterface
{
    const TRANSPORT_UDP = 'udp';

    const TRANSPORT_TCP = 'tcp';

    const TRANSPORT_TLS = 'tls';

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
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface|mixed
     */
    public function getAstPsEndpoint();

    /**
     * @return string
     */
    public function getSorcery();

    /**
     * Get Ddi associated with this retail Account
     *
     * @param string $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi($ddieE164);

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

    public function isInitialized(): bool;

    public function addPsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface;

    public function removePsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface;

    public function replacePsEndpoints(ArrayCollection $psEndpoints): RetailAccountInterface;

    public function getPsEndpoints(?Criteria $criteria = null): array;

    public function addDdi(DdiInterface $ddi): RetailAccountInterface;

    public function removeDdi(DdiInterface $ddi): RetailAccountInterface;

    public function replaceDdis(ArrayCollection $ddis): RetailAccountInterface;

    public function getDdis(?Criteria $criteria = null): array;

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): RetailAccountInterface;

    public function getCallForwardSettings(?Criteria $criteria = null): array;
}
