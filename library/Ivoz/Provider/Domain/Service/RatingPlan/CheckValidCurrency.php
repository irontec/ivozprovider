<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

class CheckValidCurrency implements RatingPlanLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * @param RatingPlanInterface $ratingPlan
     *
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $ratingPlanCurrencyIden = $ratingPlan->getRatingPlanGroup()->getCurrencyIden();
        $destinationRateCurrencyIden = $ratingPlan->getDestinationRateGroup()->getCurrencyIden();

        // Ensure entities currency are the same
        if ($ratingPlanCurrencyIden !== $destinationRateCurrencyIden) {
            throw new \DomainException("Invalid destination rate currency");
        }
    }
}
