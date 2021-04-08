<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;

/**
* TpTimingInterface
*/
interface TpTimingInterface extends EntityInterface
{

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getYears(): string;

    public function getMonths(): string;

    public function getMonthDays(): string;

    public function getWeekDays(): string;

    public function getTime(): string;

    public function getCreatedAt(): \DateTime;

    public function setRatingPlan(RatingPlan $ratingPlan): static;

    public function getRatingPlan(): RatingPlan;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
