<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* RatingPlanGroupInterface
*/
interface RatingPlanGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag();

    /**
     * @return string
     */
    public function getCurrencyIden();

    /**
     * @return string
     */
    public function getCurrencySymbol();

    /**
     * @return void
     * @throws \DomainException
     */
    public function assertNoDuplicatedDestinationRateGroups();

    public function getName(): Name;

    public function getDescription(): Description;

    public function getBrand(): BrandInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function isInitialized(): bool;

    public function addRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    public function removeRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    public function replaceRatingPlan(ArrayCollection $ratingPlan): RatingPlanGroupInterface;

    public function getRatingPlan(?Criteria $criteria = null): array;
}
