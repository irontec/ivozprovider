<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function setName($name);

    /**
     * {@inheritDoc}
     */
    public function setIp($ip = null);

    /**
     * {@inheritDoc}
     */
    public function setPassword($password = null);

    public function setPort($port = null);

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
    public function getTransport();

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp();

    /**
     * Get port
     *
     * @return integer | null
     */
    public function getPort();

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword();

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain();

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
     * @return boolean
     */
    public function getRtpEncryption(): bool;

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint);

    /**
     * Remove psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     */
    public function removePsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint);

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints);

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return static
     */
    public function addDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi);

    /**
     * Remove ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     */
    public function removeDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi);

    /**
     * Replace ddis
     *
     * @param ArrayCollection $ddis of Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis);

    /**
     * Get ddis
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function addCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting);

    /**
     * Remove callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     */
    public function removeCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting);

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings);

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(\Doctrine\Common\Collections\Criteria $criteria = null);
}
