<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency();

    /**
     * Get proxyTrunk
     *
     * @return \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface | null
     */
    public function getProxyTrunk();

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
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
     * @param ArrayCollection $outgoingRoutings of Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRoutingsRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingsRelCarrier
     *
     * @return static
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
     * @param ArrayCollection $outgoingRoutingsRelCarriers of Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface
     * @return static
     */
    public function replaceOutgoingRoutingsRelCarriers(ArrayCollection $outgoingRoutingsRelCarriers);

    /**
     * Get outgoingRoutingsRelCarriers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface[]
     */
    public function getOutgoingRoutingsRelCarriers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add server
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $server
     *
     * @return static
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
     * @param ArrayCollection $servers of Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface
     * @return static
     */
    public function replaceServers(ArrayCollection $servers);

    /**
     * Get servers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface[]
     */
    public function getServers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return static
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
     * @param ArrayCollection $ratingProfiles of Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles);

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add tpCdrStat
     *
     * @param \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface $tpCdrStat
     *
     * @return static
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
     * @param ArrayCollection $tpCdrStats of Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface
     * @return static
     */
    public function replaceTpCdrStats(ArrayCollection $tpCdrStats);

    /**
     * Get tpCdrStats
     * @param Criteria | null $criteria
     * @return \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatInterface[]
     */
    public function getTpCdrStats(\Doctrine\Common\Collections\Criteria $criteria = null);
}
