<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add ratingPlan
     *
     * @param RatingPlanInterface $ratingPlan
     *
     * @return static
     */
    public function addRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    /**
     * Remove ratingPlan
     *
     * @param RatingPlanInterface $ratingPlan
     *
     * @return static
     */
    public function removeRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    /**
     * Replace ratingPlan
     *
     * @param ArrayCollection $ratingPlan of RatingPlanInterface
     *
     * @return static
     */
    public function replaceRatingPlan(ArrayCollection $ratingPlan): RatingPlanGroupInterface;

    /**
     * Get ratingPlan
     * @param Criteria | null $criteria
     * @return RatingPlanInterface[]
     */
    public function getRatingPlan(?Criteria $criteria = null): array;

}
