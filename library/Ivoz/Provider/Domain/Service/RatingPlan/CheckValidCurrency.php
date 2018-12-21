<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\Invoice\InvoiceLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class CheckValidCurrency implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param RatingPlanInterface $ratingPlan
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $ratingPlanCurrencyIden = $ratingPlan->getRatingPlanGroup()->getCurrencyIden();
        $destinationRateCurrencyIden = $ratingPlan->getDestinationRateGroup()->getCurrencyIden();

        // Ensure entities currency are the same
        if ($ratingPlanCurrencyIden != $destinationRateCurrencyIden) {
            throw new \DomainException("Invalid destination rate currency");
        }
    }
}
