<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface RetailAccountInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

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
     * @return string
     */
    public function getSorcery();

    /**
     * Get Ddi associated with this retail Account
     *
     * @return DdiInterface
     */
    public function getDdi($ddieE164);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get transport
     *
     * @return string
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
    public function getDirectConnectivity();

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet();

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi();

    /**
     * Add psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return RetailAccountTrait
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
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[] $psEndpoints
     * @return self
     */
    public function replacePsEndpoints(Collection $psEndpoints);

    /**
     * Get psEndpoints
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return RetailAccountTrait
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
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[] $ddis
     * @return self
     */
    public function replaceDdis(Collection $ddis);

    /**
     * Get ddis
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     *
     * @return RetailAccountTrait
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
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[] $callForwardSettings
     * @return self
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings);

    /**
     * Get callForwardSettings
     *
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(\Doctrine\Common\Collections\Criteria $criteria = null);
}
