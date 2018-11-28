<?php

namespace Ivoz\Ast\Domain\Service\Queue;

use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Service\Queue\QueueLifecycleEventHandlerInterface
    as IvozQueueLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface as IvozQueueInterface;
use Ivoz\Ast\Domain\Model\Queue\QueueRepository as AstQueueRepository;

class UpdateByIvozQueue implements IvozQueueLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var AstQueueRepository
     */
    protected $astQueueRepository;

    public function __construct(
        EntityTools $entityTools,
        AstQueueRepository $astQueueRepository
    ) {
        $this->entityTools = $entityTools;
        $this->astQueueRepository = $astQueueRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(IvozQueueInterface $entity)
    {
        $periodicAnnounceLocution = $entity->getPeriodicAnnounceLocution();
        if (!is_null($periodicAnnounceLocution)) {

            /** @var LocutionDto $periodicAnnounceLocutionDto */
            $periodicAnnounceLocutionDto = $this->entityTools->entityToDto(
                $periodicAnnounceLocution
            );
            $periodicAnnounceLocution = $periodicAnnounceLocutionDto->getEncodedFilePath();

            // Remove file extension
            $periodicAnnounceLocution = pathinfo($periodicAnnounceLocution, PATHINFO_DIRNAME)
                . DIRECTORY_SEPARATOR
                . pathinfo($periodicAnnounceLocution, PATHINFO_FILENAME);
        }

        $astQueueName = $entity->getAstQueueName();

        /**
         * @var Queue $astQueue
         */
        $astQueue = $this->astQueueRepository->findOneByProviderQueueId(
            $entity->getId()
        );

        $astQueueDto = is_null($astQueue)
            ? Queue::createDto()
            : $this->entityTools->entityToDto($astQueue);

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

        $this->entityTools->persistDto($astQueueDto, $astQueue);
    }
}
