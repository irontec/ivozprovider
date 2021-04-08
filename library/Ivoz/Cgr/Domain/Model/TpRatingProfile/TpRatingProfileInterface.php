<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

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

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getDirection(): string;

    public function getTenant(): ?string;

    public function getCategory(): string;

    public function getSubject(): ?string;

    public function getActivationTime(): string;

    public function getRatingPlanTag(): ?string;

    public function getFallbackSubjects(): ?string;

    public function getCdrStatQueueIds(): ?string;

    public function getCreatedAt(): \DateTime;

    public function setRatingProfile(?RatingProfileInterface $ratingProfile = null): static;

    public function getRatingProfile(): ?RatingProfileInterface;

    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null): static;

    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
