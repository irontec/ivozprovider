<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

interface BillingServiceInterface
{
    /**
     * Simulate call and get price
     *
     * @param string $tenant
     * @param string $subject
     * @param int $durationSeconds
     */
    public function simulateCall(string $tenant, string $subject, string $destination, int $durationSeconds);
}