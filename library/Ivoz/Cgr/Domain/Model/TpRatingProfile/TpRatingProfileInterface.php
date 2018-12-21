<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpRatingProfileInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection();

    /**
     * Get tenant
     *
     * @return string | null
     */
    public function getTenant();

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory();

    /**
     * Get subject
     *
     * @return string | null
     */
    public function getSubject();

    /**
     * Get activationTime
     *
     * @return string
     */
    public function getActivationTime();

    /**
     * Get ratingPlanTag
     *
     * @return string | null
     */
    public function getRatingPlanTag();

    /**
     * Get fallbackSubjects
     *
     * @return string | null
     */
    public function getFallbackSubjects();

    /**
     * Get cdrStatQueueIds
     *
     * @return string | null
     */
    public function getCdrStatQueueIds();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return self
     */
    public function setRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile = null);

    /**
     * Get ratingProfile
     *
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface | null
     */
    public function getRatingProfile();

    /**
     * Set outgoingRoutingRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier
     *
     * @return self
     */
    public function setOutgoingRoutingRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null);

    /**
     * Get outgoingRoutingRelCarrier
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface | null
     */
    public function getOutgoingRoutingRelCarrier();
}
