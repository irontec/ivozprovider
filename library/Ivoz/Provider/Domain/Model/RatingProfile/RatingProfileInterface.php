<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* RatingProfileInterface
*/
interface RatingProfileInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Return the TpRatingProfile row associated with this RatingProfile
     *
     * @return TpRatingProfileInterface|mixed
     */
    public function getCgrRatingProfile();

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getActivationTime(): \DateTimeInterface;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function setCarrier(?CarrierInterface $carrier = null): static;

    public function getCarrier(): ?CarrierInterface;

    public function getRatingPlanGroup(): RatingPlanGroupInterface;

    public function getRoutingTag(): ?RoutingTagInterface;

    public function isInitialized(): bool;

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    public function replaceTpRatingProfiles(ArrayCollection $tpRatingProfiles): RatingProfileInterface;

    public function getTpRatingProfiles(?Criteria $criteria = null): array;
}
