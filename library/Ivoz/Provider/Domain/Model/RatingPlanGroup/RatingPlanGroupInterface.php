<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\Name
     */
    public function getName();

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\Description
     */
    public function getDescription();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return static
     */
    public function addRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Remove ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     */
    public function removeRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Replace ratingPlan
     *
     * @param ArrayCollection $ratingPlan of Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     * @return static
     */
    public function replaceRatingPlan(ArrayCollection $ratingPlan);

    /**
     * Get ratingPlan
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface[]
     */
    public function getRatingPlan(\Doctrine\Common\Collections\Criteria $criteria = null);
}
