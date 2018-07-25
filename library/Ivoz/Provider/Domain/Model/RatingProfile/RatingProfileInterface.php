<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface RatingProfileInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set activationTime
     *
     * @param \DateTime $activationTime
     *
     * @return self
     */
    public function setActivationTime($activationTime);

    /**
     * Get activationTime
     *
     * @return \DateTime
     */
    public function getActivationTime();

    /**
     * Set tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     *
     * @return self
     */
    public function setTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile = null);

    /**
     * Get tpRatingProfile
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface
     */
    public function getTpRatingProfile();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

    /**
     * Set ratingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan
     *
     * @return self
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface $ratingPlan);

    /**
     * Get ratingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface
     */
    public function getRatingPlan();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return self
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    public function getRoutingTag();

}

