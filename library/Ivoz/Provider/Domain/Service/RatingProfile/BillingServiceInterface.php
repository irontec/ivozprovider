<?php

namespace Ivoz\Provider\Domain\Service\RatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\SimulatedCall;

interface BillingServiceInterface
{
    public function simulateCallByRatingProfile(string $tenant, string $subject, string $destination, int $durationSeconds): SimulatedCall;

    public function simulateCallByRatingPlan(string $tenant, string $ratingPlanTag, string $destination, int $durationSeconds): SimulatedCall;
}
