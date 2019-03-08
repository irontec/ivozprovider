<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

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
    public function getDescription();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get externallyRated
     *
     * @return boolean | null
     */
    public function getExternallyRated();

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance();

    /**
     * Get calculateCost
     *
     * @return boolean | null
     */
    public function getCalculateCost();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

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
     * Set currency
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency
     *
     * @return self
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency = null);

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface
     */
    public function getCurrency();

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return CarrierTrait
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Replace outgoingRoutings
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[] $outgoingRoutings
     * @return self
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRoutingsRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return CarrierTrait
     */
    public function addOutgoingRoutingsRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier);

    /**
     * Remove outgoingRoutingsRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     */
    public function removeOutgoingRoutingsRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier);

    /**
     * Replace outgoingRoutingsRelCarriers
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[] $outgoingRoutingsRelCarriers
     * @return self
     */
    public function replaceOutgoingRoutingsRelCarriers(Collection $outgoingRoutingsRelCarriers);

    /**
     * Get outgoingRoutingsRelCarriers
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[]
     */
    public function getOutgoingRoutingsRelCarriers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     *
     * @return CarrierTrait
     */
    public function addServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server);

    /**
     * Remove server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     */
    public function removeServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server);

    /**
     * Replace servers
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[] $servers
     * @return self
     */
    public function replaceServers(Collection $servers);

    /**
     * Get servers
     *
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[]
     */
    public function getServers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return CarrierTrait
     */
    public function addRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile);

    /**
     * Remove ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     */
    public function removeRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile);

    /**
     * Replace ratingProfiles
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[] $ratingProfiles
     * @return self
     */
    public function replaceRatingProfiles(Collection $ratingProfiles);

    /**
     * Get ratingProfiles
     *
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add tpCdrStat
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat
     *
     * @return CarrierTrait
     */
    public function addTpCdrStat(\Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat);

    /**
     * Remove tpCdrStat
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat
     */
    public function removeTpCdrStat(\Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat);

    /**
     * Replace tpCdrStats
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface[] $tpCdrStats
     * @return self
     */
    public function replaceTpCdrStats(Collection $tpCdrStats);

    /**
     * Get tpCdrStats
     *
     * @return \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface[]
     */
    public function getTpCdrStats(\Doctrine\Common\Collections\Criteria $criteria = null);
}
