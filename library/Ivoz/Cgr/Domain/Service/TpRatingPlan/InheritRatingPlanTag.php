<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;

class InheritRatingPlanTag implements TpRatingPlanLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    /**
     * InheritRatingPlanTag constructor.
     *
     * @param EntityTools $entityTools
     * @param UpdateEntityFromDTO $entityUpdater
     */
    public function __construct(
        EntityTools $entityTools,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->entityTools = $entityTools;
        $this->entityUpdater = $entityUpdater;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST =>  self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(TpRatingPlanInterface $tpRatingPlan)
    {
        /** @var TpRatingPlanDto $tpRatingPlanDto */
        $tpRatingPlanDto = $this->entityTools->entityToDto($tpRatingPlan);

        /** Get CGRates tag from parent table */
        $tpRatingPlanDto->setTag(
            $tpRatingPlan->getRatingPlan()->getCgrTag()
        );

        $tpRatingPlanDto->setDestratesTag(
            $tpRatingPlan->getDestinationRateGroup()->getCgrTag()
        );

        $this->entityUpdater->execute(
            $tpRatingPlan,
            $tpRatingPlanDto
        );
    }
}
