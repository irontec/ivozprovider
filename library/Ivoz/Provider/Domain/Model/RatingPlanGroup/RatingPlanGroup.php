<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

/**
 * RatingPlanGroup
 */
class RatingPlanGroup extends RatingPlanGroupAbstract implements RatingPlanGroupInterface
{
    use RatingPlanGroupTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag(): string
    {
        return sprintf(
            "b%drp%d",
            (int) $this->getBrand()->getId(),
            (int) $this->getId()
        );
    }

    /**
     * @return string
     */
    public function getCurrencyIden(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencyIden();
        }
        return $currency->getIden();
    }


    /**
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        $currency = $this->getCurrency();
        if (!$currency) {
            return $this->getBrand()->getCurrencySymbol();
        }
        return $currency->getSymbol();
    }

    /**
     * @return void
     * @throws \DomainException
     */
    public function assertNoDuplicatedDestinationRateGroups()
    {
        $ratingPlans = $this->getRatingPlan();
        if (empty($ratingPlans)) {
            return;
        }

        $destinationRateGroupIds = [];

        foreach ($ratingPlans as $ratingPlan) {
            $destinationRateGroupId = $ratingPlan
                ->getDestinationRateGroup()
                ->getId();

            $duplicated = in_array(
                $destinationRateGroupId,
                $destinationRateGroupIds,
                true
            );

            if ($duplicated) {
                throw new \DomainException(
                    'Duplicated destination rate group in rating plan group'
                );
            }

            $destinationRateGroupIds[] = $destinationRateGroupId;
        }
    }
}
