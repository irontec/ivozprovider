<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Service\RatingProfile\RatingProfileLifecycleEventHandlerInterface;

class UpdateByRatingProfile implements RatingProfileLifecycleEventHandlerInterface
{
    CONST POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(RatingProfileInterface $ratingProfile, $isNew)
    {
        $tpRatingProfile = $ratingProfile->getTpRatingProfile();

        /** @var TpRatingProfileDto $tpRatingProfileDto */
        $tpRatingProfileDto = is_null($tpRatingProfile)
            ? TpRatingProfile::createDto()
            : $this->entityTools->entityToDto($tpRatingProfile);

        $company = $ratingProfile->getCompany();
        $carrier = $ratingProfile->getCarrier();

        if ($company) {
            $brand = $company->getBrand();
        } else {
            $brand = $carrier->getBrand();
        }

        $ratingPlan = $ratingProfile->getRatingPlan();
        $routingTag = $ratingProfile->getRoutingTag();

        // Update/Create TpRatingPorfile for this RatingProfile
        $tpRatingProfileDto
            ->setActivationTime($ratingProfile->getActivationTime())
            ->setTenant(sprintf("b%d", $brand->getId()))
            ->setRatingPlanTag($ratingPlan->getTag())
            ->setRatingProfileId($ratingProfile->getId());


        if ($company) {
            $tpRatingProfileDto->setSubject(
                sprintf("c%d",
                    $company->getId()
                )
            );
        }

        if ($carrier) {
            $tpRatingProfileDto
                ->setSubject(sprintf("cr%d",$carrier->getId()))
                ->setCdrStatQueueIds(sprintf("cr%d", $carrier->getId())
            );
        }

        if ($routingTag) {
            $tpRatingProfileDto->setSubject(
                sprintf("%srt%d",
                    $tpRatingProfileDto->getSubject(),
                    $routingTag->getId()
                )
            );
        }

        $tpRatingProfile = $this->entityTools->persistDto(
            $tpRatingProfileDto,
            $tpRatingProfile,
            true
        );

        $ratingProfile
            ->setTpRatingProfile($tpRatingProfile);

        $this->entityTools->persist($ratingProfile);
    }
}
