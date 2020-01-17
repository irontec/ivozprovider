<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @return \DateTime
     */
    public function getActivationTime();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier | null
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup);

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    public function getRatingPlanGroup();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag | null
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface | null
     */
    public function getRoutingTag();

    /**
     * Add tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     *
     * @return static
     */
    public function addTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile);

    /**
     * Remove tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     */
    public function removeTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile);

    /**
     * Replace tpRatingProfiles
     *
     * @param ArrayCollection $tpRatingProfiles of Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface
     * @return static
     */
    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles);

    /**
     * Get tpRatingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[]
     */
    public function getTpRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);
}
