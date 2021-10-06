<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

class CreatedByOutgoingRoutingRelCarrier
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * Create a new TpRatingProfile for each TpRatingProfile of the Carrier
     *
     * @param OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier
     *
     * @return void
     */
    public function execute(OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier)
    {
        $carrier = $outgoingRoutingRelCarrier->getCarrier();

        $outgoingRouting = $outgoingRoutingRelCarrier->getOutgoingRouting();

        $ratingProfiles = $carrier->getRatingProfiles();

        foreach ($ratingProfiles as $ratingProfile) {
            /** @var TpRatingProfileInterface $carrierTpRatingProfile */
            $carrierTpRatingProfile = $ratingProfile->getCgrRatingProfile();

            // Check if this TpRatingPlan already exists for current OutgoingRouting
            $outgoingRoutingTpRatingProfiles =
                $outgoingRoutingRelCarrier->getTpRatingProfiles(
                    CriteriaHelper::fromArray([
                        [ 'ratingProfile', 'eq', $ratingProfile ],
                    ])
                );
            $outgoingRoutingTpRatingProfile = array_shift($outgoingRoutingTpRatingProfiles);


            /** @var TpRatingProfileDto $lcrTpRatingProfileDto */
            $lcrTpRatingProfileDto = is_null($outgoingRoutingTpRatingProfile)
                ? TpRatingProfile::createDto()
                : $this->entityTools->entityToDto($outgoingRoutingTpRatingProfile);

            $lcrTpRatingProfileDto
                ->setTpid($carrierTpRatingProfile->getTpid())
                ->setTenant($carrierTpRatingProfile->getTenant())
                ->setCategory($outgoingRouting->getCgrRpCategory())
                ->setSubject($carrierTpRatingProfile->getSubject())
                ->setActivationTime($carrierTpRatingProfile->getActivationTime())
                ->setRatingPlanTag($carrierTpRatingProfile->getRatingPlanTag())
                ->setRatingProfileId($ratingProfile->getId())
                ->setOutgoingRoutingRelCarrierId($outgoingRoutingRelCarrier->getId());

            $this->entityTools
                ->persistDto(
                    $lcrTpRatingProfileDto,
                    $outgoingRoutingTpRatingProfile,
                    false
                );
        }
    }
}
