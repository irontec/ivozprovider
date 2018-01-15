<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanDTO;
use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;
use Ivoz\Cgr\Infrastructure\Persistence\Doctrine\TpRatingPlanDoctrineRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;

class UpdateByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var TpRatingPlanDoctrineRepository
     */
    protected $tpRatingPlanRepository;

    /**
     * UpdateByDestinationTpRatingPlan constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param TpRatingPlanDoctrineRepository $tpRatingPlanRepository
     */
    public function __construct(
        EntityPersisterInterface $entityPersister,
        TpRatingPlanDoctrineRepository $tpRatingPlanRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->tpRatingPlanRepository = $tpRatingPlanRepository;
    }

    public function execute(RatingPlanInterface $entity)
    {
        /** @var RatingPlanDTO $entityDto */
        $entityDto = $entity->toDTO();

        // Find associated rating plan for destination rate
        $tpRatingPlan = $this->tpRatingPlanRepository->findOneBy([
            'ratingPlan' => $entity->getId()
        ]);

        $tpRatingPlanDto = is_null($tpRatingPlan)
            ? TpRatingPlan::createDTO()
            : $tpRatingPlan->toDTO();

        // Fill all rating plan fields
        $tpRatingPlanDto
            ->setRatingPlanId($entityDto->getId())
            ->setTimingTag('ALWAYS')
            ->setTimingId(1)
            ->setWeight(10)
            ->setDestinationRateId($entityDto->getDestinationRateId());

        $this->entityPersister->persistDto($tpRatingPlanDto, $tpRatingPlan);

    }

}
