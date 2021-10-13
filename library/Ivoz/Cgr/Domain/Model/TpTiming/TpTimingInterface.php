<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

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

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static;

    public function getRatingPlan(): RatingPlanInterface;

    public function isInitialized(): bool;
}
