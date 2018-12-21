<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set currency
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency
     *
     * @return self
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency = null);

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface
     */
    public function getCurrency();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\RatingPlanGroup\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\RatingPlanGroup\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\Description
     */
    public function getDescription();

    /**
     * Add ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return RatingPlanGroupTrait
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
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface[] $ratingPlan
     * @return self
     */
    public function replaceRatingPlan(Collection $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface[]
     */
    public function getRatingPlan(\Doctrine\Common\Collections\Criteria $criteria = null);
}
