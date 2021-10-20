<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

/**
* TpRatingPlanInterface
*/
interface TpRatingPlanInterface extends LoggableEntityInterface
{

    public function getChangeSet(): array;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getDestratesTag(): ?string;

    public function getTimingTag(): string;

    public function getWeight(): float;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static;

    public function getRatingPlan(): RatingPlanInterface;

    public function isInitialized(): bool;
}
