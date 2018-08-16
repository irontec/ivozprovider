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
     * @deprecated
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @deprecated
     * Set externallyRated
     *
     * @param boolean $externallyRated
     *
     * @return self
     */
    public function setExternallyRated($externallyRated = null);

    /**
     * Get externallyRated
     *
     * @return boolean
     */
    public function getExternallyRated();

    /**
     * @deprecated
     * Set balance
     *
     * @param string $balance
     *
     * @return self
     */
    public function setBalance($balance = null);

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance();

    /**
     * @deprecated
     * Set calculateCost
     *
     * @param boolean $calculateCost
     *
     * @return self
     */
    public function setCalculateCost($calculateCost = null);

    /**
     * Get calculateCost
     *
     * @return boolean
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

