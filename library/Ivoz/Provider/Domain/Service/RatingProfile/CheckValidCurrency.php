<?php

namespace Ivoz\Provider\Domain\Service\RatingProfile;

use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;

class CheckValidCurrency implements RatingProfileLifecycleEventHandlerInterface
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
     * @param RatingProfileInterface $ratingProfile
     */
    public function execute(RatingProfileInterface $ratingProfile)
    {
        $ratingPlanCurrencyIden = $ratingProfile->getRatingPlanGroup()->getCurrencyIden();

        $company = $ratingProfile->getCompany();
        if ($company) {
            $clientCurrencyIden = $company->getCurrencyIden();
        } else {
            $carrier = $ratingProfile->getCarrier();
            $clientCurrencyIden = $carrier->getCurrencyIden();
        }

        // Ensure entities currency are the same
        if ($ratingPlanCurrencyIden != $clientCurrencyIden) {
            throw new \DomainException("Invalid rating plan currency");
        }
    }
}
