<?php

namespace Ivoz\Ast\Domain\Service\Queue;

use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Core\Application\Service\CommonStoragePathResolver;
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

    /**
     * @var CommonStoragePathResolver
     */
    protected $storagePathResolver;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        AstQueueRepository $astQueueRepository,
        CommonStoragePathResolver $storagePathResolver
    ) {
        $this->entityPersister = $entityPersister;
        $this->astQueueRepository = $astQueueRepository;
        $this->storagePathResolver = $storagePathResolver;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(IvozQueueInterface $entity, $isNew)
    {
        $periodicAnnounceLocution = $entity->getPeriodicAnnounceLocution();
        if (!is_null($periodicAnnounceLocution)) {
            $periodicAnnounceLocution = $this
                ->storagePathResolver
                ->getFilePath($periodicAnnounceLocution);

            // Remove file extension
            $periodicAnnounceLocution = pathinfo($periodicAnnounceLocution, PATHINFO_DIRNAME)
                . DIRECTORY_SEPARATOR
                . pathinfo($periodicAnnounceLocution, PATHINFO_FILENAME);
        }

        $astQueueName = $entity->getAstQueueName();

        /**
         * @var Queue $astQueue
         */
        $astQueue = $this->astQueueRepository->findOneBy([
            'queue' => $entity->getId()
        ]);

        $astQueueDto = is_null($astQueue)
            ? Queue::createDto()
            : $astQueue->toDto();

        $astQueueDto
            ->setQueueId($entity->getId())
            ->setName($astQueueName)
            ->setPeriodicAnnounce($periodicAnnounceLocution)
            ->setPeriodicAnnounceFrequency($entity->getPeriodicAnnounceFrequency())
            ->setStrategy($entity->getStrategy())
            ->setTimeout($entity->getMemberCallTimeout())
            ->setWrapuptime($entity->getMemberCallRest())
            ->setWeight($entity->getWeight())
            ->setMaxlen($entity->getMaxlen());

        $this->entityPersister->persistDto($astQueueDto, $astQueue);
    }
}
