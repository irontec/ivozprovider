<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;

/**
* TpRatingPlanInterface
*/
interface TpRatingPlanInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getDestratesTag(): ?string;

    public function getTimingTag(): string;

    public function getWeight(): float;

    public function getCreatedAt(): \DateTime;

    public function setRatingPlan(RatingPlan $ratingPlan): static;

    public function getRatingPlan(): RatingPlan;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
