<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpRatingProfileInterface
*/
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
    public function getTpid(): string;

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid(): string;

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection(): string;

    /**
     * Get tenant
     *
     * @return string | null
     */
    public function getTenant(): ?string;

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory(): string;

    /**
     * Get subject
     *
     * @return string | null
     */
    public function getSubject(): ?string;

    /**
     * Get activationTime
     *
     * @return string
     */
    public function getActivationTime(): string;

    /**
     * Get ratingPlanTag
     *
     * @return string | null
     */
    public function getRatingPlanTag(): ?string;

    /**
     * Get fallbackSubjects
     *
     * @return string | null
     */
    public function getFallbackSubjects(): ?string;

    /**
     * Get cdrStatQueueIds
     *
     * @return string | null
     */
    public function getCdrStatQueueIds(): ?string;

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Set ratingProfile
     *
     * @param RatingProfileInterface | null
     *
     * @return static
     */
    public function setRatingProfile(?RatingProfileInterface $ratingProfile = null): TpRatingProfileInterface;

    /**
     * Get ratingProfile
     *
     * @return RatingProfileInterface | null
     */
    public function getRatingProfile(): ?RatingProfileInterface;

    /**
     * Set outgoingRoutingRelCarrier
     *
     * @param OutgoingRoutingRelCarrierInterface | null
     *
     * @return static
     */
    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null): TpRatingProfileInterface;

    /**
     * Get outgoingRoutingRelCarrier
     *
     * @return OutgoingRoutingRelCarrierInterface | null
     */
    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
