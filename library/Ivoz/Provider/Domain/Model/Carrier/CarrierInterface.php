<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CarrierInterface
*/
interface CarrierInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return string
     */
    public function getCgrSubject();

    /**
     * @return string
     */
    public function getCurrencySymbol();

    /**
     * @return string
     */
    public function getCurrencyIden();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get externallyRated
     *
     * @return bool | null
     */
    public function getExternallyRated(): ?bool;

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance(): ?float;

    /**
     * Get calculateCost
     *
     * @return bool | null
     */
    public function getCalculateCost(): ?bool;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface;

    /**
     * Get proxyTrunk
     *
     * @return ProxyTrunkInterface | null
     */
    public function getProxyTrunk(): ?ProxyTrunkInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): CarrierInterface;

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): CarrierInterface;

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    /**
     * Add outgoingRoutingsRelCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
     */
    public function addOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    /**
     * Remove outgoingRoutingsRelCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
     */
    public function removeOutgoingRoutingsRelCarrier(OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier): CarrierInterface;

    /**
     * Replace outgoingRoutingsRelCarriers
     *
     * @param ArrayCollection $outgoingRoutingsRelCarriers of OutgoingRoutingRelCarrierInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutingsRelCarriers(ArrayCollection $outgoingRoutingsRelCarriers): CarrierInterface;

    /**
     * Get outgoingRoutingsRelCarriers
     * @param Criteria | null $criteria
     * @return OutgoingRoutingRelCarrierInterface[]
     */
    public function getOutgoingRoutingsRelCarriers(?Criteria $criteria = null): array;

    /**
     * Add server
     *
     * @param CarrierServerInterface $server
     *
     * @return static
     */
    public function addServer(CarrierServerInterface $server): CarrierInterface;

    /**
     * Remove server
     *
     * @param CarrierServerInterface $server
     *
     * @return static
     */
    public function removeServer(CarrierServerInterface $server): CarrierInterface;

    /**
     * Replace servers
     *
     * @param ArrayCollection $servers of CarrierServerInterface
     *
     * @return static
     */
    public function replaceServers(ArrayCollection $servers): CarrierInterface;

    /**
     * Get servers
     * @param Criteria | null $criteria
     * @return CarrierServerInterface[]
     */
    public function getServers(?Criteria $criteria = null): array;

    /**
     * Add ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    /**
     * Remove ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CarrierInterface;

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of RatingProfileInterface
     *
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles): CarrierInterface;

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return RatingProfileInterface[]
     */
    public function getRatingProfiles(?Criteria $criteria = null): array;

    /**
     * Add tpCdrStat
     *
     * @param TpCdrStatInterface $tpCdrStat
     *
     * @return static
     */
    public function addTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    /**
     * Remove tpCdrStat
     *
     * @param TpCdrStatInterface $tpCdrStat
     *
     * @return static
     */
    public function removeTpCdrStat(TpCdrStatInterface $tpCdrStat): CarrierInterface;

    /**
     * Replace tpCdrStats
     *
     * @param ArrayCollection $tpCdrStats of TpCdrStatInterface
     *
     * @return static
     */
    public function replaceTpCdrStats(ArrayCollection $tpCdrStats): CarrierInterface;

    /**
     * Get tpCdrStats
     * @param Criteria | null $criteria
     * @return TpCdrStatInterface[]
     */
    public function getTpCdrStats(?Criteria $criteria = null): array;

}
