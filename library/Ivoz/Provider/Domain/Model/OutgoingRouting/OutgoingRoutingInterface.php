<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface OutgoingRoutingInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return RoutingPatternInterface[]
     */
    public function getRoutingPatterns();

    /**
     * Return CGRates tag for LCR category
     *
     * @return string
     */
    public function getCgrCategory();

    /**
     * Return CGRates tag for LCR rating plan category
     *
     * @return string
     */
    public function getCgrRpCategory();

    /**
     * @param RoutingPatternInterface $pattern
     * @return bool
     */
    public function hasRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $pattern);

    /**
     * Get type
     *
     * @return string | null
     */
    public function getType();

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Get routingMode
     *
     * @return string | null
     */
    public function getRoutingMode();

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix();

    /**
     * Get forceClid
     *
     * @return boolean | null
     */
    public function getForceClid();

    /**
     * Get clid
     *
     * @return string | null
     */
    public function getClid();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern();

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup
     *
     * @return self
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null);

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface
     */
    public function getRoutingPatternGroup();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return self
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    public function getRoutingTag();

    /**
     * Set clidCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry
     *
     * @return self
     */
    public function setClidCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $clidCountry = null);

    /**
     * Get clidCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getClidCountry();

    /**
     * Set tpLcrRule
     *
     * @param \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface $tpLcrRule
     *
     * @return self
     */
    public function setTpLcrRule(\Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface $tpLcrRule = null);

    /**
     * Get tpLcrRule
     *
     * @return \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface
     */
    public function getTpLcrRule();

    /**
     * Add lcrRule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule
     *
     * @return OutgoingRoutingTrait
     */
    public function addLcrRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule);

    /**
     * Remove lcrRule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule
     */
    public function removeLcrRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule);

    /**
     * Replace lcrRules
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface[] $lcrRules
     * @return self
     */
    public function replaceLcrRules(Collection $lcrRules);

    /**
     * Get lcrRules
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface[]
     */
    public function getLcrRules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add lcrRuleTarget
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return OutgoingRoutingTrait
     */
    public function addLcrRuleTarget(\Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface $lcrRuleTarget);

    /**
     * Remove lcrRuleTarget
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface $lcrRuleTarget
     */
    public function removeLcrRuleTarget(\Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface $lcrRuleTarget);

    /**
     * Replace lcrRuleTargets
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface[] $lcrRuleTargets
     * @return self
     */
    public function replaceLcrRuleTargets(Collection $lcrRuleTargets);

    /**
     * Get lcrRuleTargets
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface[]
     */
    public function getLcrRuleTargets(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return OutgoingRoutingTrait
     */
    public function addRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $relCarrier);

    /**
     * Remove relCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $relCarrier
     */
    public function removeRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $relCarrier);

    /**
     * Replace relCarriers
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[] $relCarriers
     * @return self
     */
    public function replaceRelCarriers(Collection $relCarriers);

    /**
     * Get relCarriers
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[]
     */
    public function getRelCarriers(\Doctrine\Common\Collections\Criteria $criteria = null);
}
