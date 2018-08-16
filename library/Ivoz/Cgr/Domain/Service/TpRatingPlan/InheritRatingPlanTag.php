<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Application\Service\EntityTools;

class InheritRatingPlanTag implements TpRatingPlanLifecycleEventHandlerInterface
{
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
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TpRatingPlanInterface $tpRatingPlan)
    {
        /** @var TpRatingPlanDto $tpRatingPlanDto */
        $tpRatingPlanDto = $this->entityTools->entityToDto($tpRatingPlan);

        /** Get CGRates tag from parent table */
        $tpRatingPlanDto->setTag(
            $tpRatingPlan->getRatingPlan()->getTag()
        );

        $tpRatingPlan->setDestratesTag(
            $tpRatingPlan->getDestinationRateGroup()->getCgrTag()
        );

        $this->entityTools->persistDto(
            $tpRatingPlanDto,
            $tpRatingPlan,
            false
        );
    }

}
