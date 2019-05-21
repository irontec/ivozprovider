<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class UpdateByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
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

    /**
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $tpRatingPlan = $ratingPlan->getTpRatingPlan();
        $brand = $ratingPlan->getRatingPlanGroup()->getBrand();
        $destinationRateGroup = $ratingPlan->getDestinationRateGroup();

        /** @var TpRatingPlanDto $tpRatingPlanDto */
        $tpRatingPlanDto = is_null($tpRatingPlan)
            ? TpRatingPlan::createDto()
            : $this->entityTools->entityToDto($tpRatingPlan);


        // Update/Create TpRatingPorfile for this RatingPlan
        $tpRatingPlanDto
            ->setTpid($brand->getCgrTenant())
            ->setTag($ratingPlan->getCgrTag())
            ->setDestratesTag($destinationRateGroup->getCgrTag())
            ->setTimingTag($ratingPlan->getCgrTimingTag())
            ->setWeight($ratingPlan->getWeight())
            ->setRatingPlanId($ratingPlan->getId());

        $tpRatingPlan = $this->entityTools->persistDto(
            $tpRatingPlanDto,
            $tpRatingPlan,
            false
        );

        $ratingPlan->setTpRatingPlan($tpRatingPlan);
    }
}
