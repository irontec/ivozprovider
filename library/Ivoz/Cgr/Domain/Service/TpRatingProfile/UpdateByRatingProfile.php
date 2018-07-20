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

        $compay = $ratingProfile->getCompany();
        $brand = $compay->getBrand();
        $ratingPlan = $ratingProfile->getRatingPlan();
        $routingTag = $ratingProfile->getRoutingTag();

        // Update/Create TpRatingPorfile for this RatingProfile
        $tpRatingProfileDto
            ->setActivationTime($ratingProfile->getActivationTime())
            ->setTenant(sprintf("b%d", $brand->getId()))
            ->setRatingPlanTag($ratingPlan->getTag())
            ->setRatingProfileId($ratingProfile->getId());

        if ($routingTag) {
            $tpRatingProfileDto->setSubject(
                sprintf("c%drt%d",
                    $compay->getId(),
                    $routingTag->getId()
                )
            );
        } else {
            $tpRatingProfileDto->setSubject(
                sprintf("c%d",
                    $compay->getId()
                )
            );
        }

        $tpRatingProfile = $this->entityTools->persistDto(
            $tpRatingProfileDto,
            $tpRatingProfile,
            true
        );

        $ratingProfile->setTpRatingProfile($tpRatingProfile);
    }
}
