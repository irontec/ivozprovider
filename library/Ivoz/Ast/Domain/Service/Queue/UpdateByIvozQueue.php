<?php

namespace Ivoz\Ast\Domain\Service\Queue;

use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Service\Queue\QueueLifecycleEventHandlerInterface
    as IvozQueueLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface as IvozQueueInterface;
use Ivoz\Ast\Domain\Model\Queue\QueueRepository as AstQueueRepository;

class UpdateByIvozQueue implements IvozQueueLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var AstQueueRepository
     */
    protected $astQueueRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        AstQueueRepository $astQueueRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->astQueueRepository = $astQueueRepository;
    }

    public function execute(IvozQueueInterface $entity, $isNew)
    {
        $periodicAnnounceLocution = $entity->getPeriodicAnnounceLocution();
        if (!is_null($periodicAnnounceLocution)) {
            $periodicAnnounceLocution = $periodicAnnounceLocution->getLocutionPath();
        }

        $astQueueName = $entity->getAstQueueName();

        /**
         * @var Queue $astQueue
         */
        $astQueue = $this->astQueueRepository->findOneBy([
            'queue' => $entity->getId()
        ]);

        $astQueueDTO = is_null($astQueue)
            ? Queue::createDTO()
            : $astQueue->toDTO();

        $astQueueDTO
            ->setQueueId($entity->getId())
            ->setName($astQueueName)
            ->setPeriodicAnnounce($periodicAnnounceLocution)
            ->setPeriodicAnnounceFrequency($entity->getPeriodicAnnounceFrequency())
            ->setStrategy($entity->getStrategy())
            ->setTimeout($entity->getMemberCallTimeout())
            ->setWrapuptime($entity->getMemberCallRest())
            ->setWeight($entity->getWeight())
            ->setMaxlen($entity->getMaxlen());

        $this->entityPersister->persistDto($astQueueDTO, $astQueue);
    }
}