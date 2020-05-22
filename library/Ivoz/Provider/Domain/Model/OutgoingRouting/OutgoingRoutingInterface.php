<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface OutgoingRoutingInterface extends LoggableEntityInterface
{
    const ROUTINGMODE_STATIC = 'static';
    const ROUTINGMODE_LCR = 'lcr';
    const ROUTINGMODE_BLOCK = 'block';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @todo awkward return type
     * @return array of \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface or null
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
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $pattern
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
     * Get stopper
     *
     * @return boolean
     */
    public function getStopper();

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
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier | null
     *
     * @return static
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
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern | null
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    public function getRoutingPattern();

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null);

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag | null
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface | null
     */
    public function getRoutingTag();

    /**
     * Get clidCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getClidCountry();

    /**
     * Set tpLcrRule
     *
     * @param \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface $tpLcrRule
     *
     * @return static
     */
    public function setTpLcrRule(\Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface $tpLcrRule = null);

    /**
     * Get tpLcrRule
     *
     * @return \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface | null
     */
    public function getTpLcrRule();

    /**
     * Add lcrRule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule
     *
     * @return static
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
     * @param ArrayCollection $lcrRules of Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface
     * @return static
     */
    public function replaceLcrRules(ArrayCollection $lcrRules);

    /**
     * Get lcrRules
     * @param Criteria | null $criteria
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface[]
     */
    public function getLcrRules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add lcrRuleTarget
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return static
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
     * @param ArrayCollection $lcrRuleTargets of Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface
     * @return static
     */
    public function replaceLcrRuleTargets(ArrayCollection $lcrRuleTargets);

    /**
     * Get lcrRuleTargets
     * @param Criteria | null $criteria
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface[]
     */
    public function getLcrRuleTargets(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return static
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
     * @param ArrayCollection $relCarriers of Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface
     * @return static
     */
    public function replaceRelCarriers(ArrayCollection $relCarriers);

    /**
     * Get relCarriers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[]
     */
    public function getRelCarriers(\Doctrine\Common\Collections\Criteria $criteria = null);
}
