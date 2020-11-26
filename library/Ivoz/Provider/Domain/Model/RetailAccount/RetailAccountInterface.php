<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setName(string $name): RetailAccountInterface;

    /**
     * {@inheritDoc}
     */
    public function setIp(string $ip = null): RetailAccountInterface;

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password = null): RetailAccountInterface;

    public function setPort(int $port = null): RetailAccountInterface;

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
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string;

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
    public function setBrand(BrandInterface $brand): RetailAccountInterface;

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
    public function setDomain(?DomainInterface $domain = null): RetailAccountInterface;

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
     * Get outgoingDdi
     *
     * @return DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface;

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
    public function addPsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface;

    /**
     * Remove psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function removePsEndpoint(PsEndpointInterface $psEndpoint): RetailAccountInterface;

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints): RetailAccountInterface;

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
    public function addDdi(DdiInterface $ddi): RetailAccountInterface;

    /**
     * Remove ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function removeDdi(DdiInterface $ddi): RetailAccountInterface;

    /**
     * Replace ddis
     *
     * @param ArrayCollection $ddis of DdiInterface
     *
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis): RetailAccountInterface;

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
    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    /**
     * Remove callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): RetailAccountInterface;

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of CallForwardSettingInterface
     *
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): RetailAccountInterface;

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(?Criteria $criteria = null): array;

}
