<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* OutgoingRoutingInterface
*/
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
    public function hasRoutingPattern(RoutingPatternInterface $pattern);

    /**
     * Get type
     *
     * @return string | null
     */
    public function getType(): ?string;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int;

    /**
     * Get routingMode
     *
     * @return string | null
     */
    public function getRoutingMode(): ?string;

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix(): ?string;

    /**
     * Get stopper
     *
     * @return bool
     */
    public function getStopper(): bool;

    /**
     * Get forceClid
     *
     * @return bool | null
     */
    public function getForceClid(): ?bool;

    /**
     * Get clid
     *
     * @return string | null
     */
    public function getClid(): ?string;

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): OutgoingRoutingInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    public function setCarrier(?CarrierInterface $carrier = null): OutgoingRoutingInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Set routingPattern
     *
     * @param RoutingPatternInterface | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): OutgoingRoutingInterface;

    /**
     * Get routingPattern
     *
     * @return RoutingPatternInterface | null
     */
    public function getRoutingPattern(): ?RoutingPatternInterface;

    /**
     * Set routingPatternGroup
     *
     * @param RoutingPatternGroupInterface | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): OutgoingRoutingInterface;

    /**
     * Get routingPatternGroup
     *
     * @return RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface;

    /**
     * Set routingTag
     *
     * @param RoutingTagInterface | null
     *
     * @return static
     */
    public function setRoutingTag(?RoutingTagInterface $routingTag = null): OutgoingRoutingInterface;

    /**
     * Get routingTag
     *
     * @return RoutingTagInterface | null
     */
    public function getRoutingTag(): ?RoutingTagInterface;

    /**
     * Get clidCountry
     *
     * @return CountryInterface | null
     */
    public function getClidCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TpLcrRuleInterface
     * mappedBy outgoingRouting
     */
    public function setTpLcrRule(TpLcrRuleInterface $tpLcrRule): OutgoingRoutingInterface;

    /**
     * Get tpLcrRule
     * @return TpLcrRuleInterface
     */
    public function getTpLcrRule(): ?TpLcrRuleInterface;

    /**
     * Add lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface;

    /**
     * Remove lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): OutgoingRoutingInterface;

    /**
     * Replace lcrRules
     *
     * @param ArrayCollection $lcrRules of TrunksLcrRuleInterface
     *
     * @return static
     */
    public function replaceLcrRules(ArrayCollection $lcrRules): OutgoingRoutingInterface;

    /**
     * Get lcrRules
     * @param Criteria | null $criteria
     * @return TrunksLcrRuleInterface[]
     */
    public function getLcrRules(?Criteria $criteria = null): array;

    /**
     * Add lcrRuleTarget
     *
     * @param TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return static
     */
    public function addLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface;

    /**
     * Remove lcrRuleTarget
     *
     * @param TrunksLcrRuleTargetInterface $lcrRuleTarget
     *
     * @return static
     */
    public function removeLcrRuleTarget(TrunksLcrRuleTargetInterface $lcrRuleTarget): OutgoingRoutingInterface;

    /**
     * Replace lcrRuleTargets
     *
     * @param ArrayCollection $lcrRuleTargets of TrunksLcrRuleTargetInterface
     *
     * @return static
     */
    public function replaceLcrRuleTargets(ArrayCollection $lcrRuleTargets): OutgoingRoutingInterface;

    /**
     * Get lcrRuleTargets
     * @param Criteria | null $criteria
     * @return TrunksLcrRuleTargetInterface[]
     */
    public function getLcrRuleTargets(?Criteria $criteria = null): array;

    /**
     * Add relCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return static
     */
    public function addRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface;

    /**
     * Remove relCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $relCarrier
     *
     * @return static
     */
    public function removeRelCarrier(OutgoingRoutingRelCarrierInterface $relCarrier): OutgoingRoutingInterface;

    /**
     * Replace relCarriers
     *
     * @param ArrayCollection $relCarriers of OutgoingRoutingRelCarrierInterface
     *
     * @return static
     */
    public function replaceRelCarriers(ArrayCollection $relCarriers): OutgoingRoutingInterface;

    /**
     * Get relCarriers
     * @param Criteria | null $criteria
     * @return OutgoingRoutingRelCarrierInterface[]
     */
    public function getRelCarriers(?Criteria $criteria = null): array;

}
