<?php

namespace Ivoz\Cgr\Domain\Service\RatingPlan;

use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDTO;
use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Cgr\Domain\Service\DestinationRate\DestinationRateLifecycleEventHandlerInterface;
use Ivoz\Cgr\Infrastructure\Persistence\Doctrine\RatingPlanDoctrineRepository;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;

class UpdateByDestinationRate implements DestinationRateLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var RatingPlanDoctrineRepository
     */
    protected $ratingPlanRepository;

    /**
     * UpdateByDestinationRatingPlan constructor.
     * @param EntityPersisterInterface $entityPersister
     * @param RatingPlanDoctrineRepository $ratingPlanRepository
     */
    public function __construct(
        EntityPersisterInterface $entityPersister,
        RatingPlanDoctrineRepository $ratingPlanRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->ratingPlanRepository = $ratingPlanRepository;
    }

    public function execute(DestinationRateInterface $entity)
    {
        /** @var DestinationRateDTO $entityDto */
        $entityDto = $entity->toDTO();

        // Find associated rating plan for destination rate
        $ratingPlan = $this->ratingPlanRepository->findOneBy([
            'destinationRate' => $entity->getId()
        ]);

        $ratingPlanDTO = is_null($ratingPlan)
            ? RatingPlan::createDTO()
            : $ratingPlan->toDTO();

        // Fill all rating plan fields
        $ratingPlanDTO
            ->setDestinationRateId($entityDto->getId())
            ->setBrandId($entityDto->getBrandId())
            ->setNameEn($entityDto->getNameEn())
            ->setNameEs($entityDto->getNameEs())
            ->setDescriptionEn($entityDto->getDescriptionEn())
            ->setDescriptionEs($entityDto->getDescriptionEs());

        $this->entityPersister->persistDto($ratingPlanDTO, $ratingPlan);

    }

}
