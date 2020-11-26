<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RatingProfileInterface
*/
interface RatingProfileInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return the TpRatingProfile row associated with this RatingProfile
     *
     * @return TpRatingProfileInterface|mixed
     */
    public function getCgrRatingProfile();

    /**
     * Get activationTime
     *
     * @return \DateTimeInterface
     */
    public function getActivationTime(): \DateTimeInterface;

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): RatingProfileInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    public function setCarrier(?CarrierInterface $carrier = null): RatingProfileInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface;

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface
     */
    public function getRatingPlanGroup(): RatingPlanGroupInterface;

    /**
     * Get routingTag
     *
     * @return RoutingTagInterface | null
     */
    public function getRoutingTag(): ?RoutingTagInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add tpRatingProfile
     *
     * @param TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    /**
     * Remove tpRatingProfile
     *
     * @param TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    /**
     * Replace tpRatingProfiles
     *
     * @param ArrayCollection $tpRatingProfiles of TpRatingProfileInterface
     *
     * @return static
     */
    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles): RatingProfileInterface;

    /**
     * Get tpRatingProfiles
     * @param Criteria | null $criteria
     * @return TpRatingProfileInterface[]
     */
    public function getTpRatingProfiles(?Criteria $criteria = null): array;

}
