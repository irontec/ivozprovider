<?php

namespace Ivoz\Ast\Domain\Service\Queue;

use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Ast\Domain\Model\Queue\QueueDto;
use Ivoz\Ast\Domain\Model\Queue\QueueRepository as AstQueueRepository;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface as IvozQueueInterface;
use Ivoz\Provider\Domain\Service\Queue\QueueLifecycleEventHandlerInterface
    as IvozQueueLifecycleEventHandlerInterface;

class UpdateByIvozQueue implements IvozQueueLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private AstQueueRepository $astQueueRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(IvozQueueInterface $queue)
    {
        $periodicAnnounceLocution = $queue->getPeriodicAnnounceLocution();
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

        $astQueueName = $queue->getAstQueueName();

        $astQueue = $this->astQueueRepository->findOneByProviderQueueId(
            (int) $queue->getId()
        );

        /** @var QueueDto $astQueueDto */
        $astQueueDto = is_null($astQueue)
            ? Queue::createDto()
            : $this->entityTools->entityToDto($astQueue);

        $astQueueDto
            ->setQueueId($queue->getId())
            ->setName($astQueueName)
            ->setPeriodicAnnounce($periodicAnnounceLocution)
            ->setPeriodicAnnounceFrequency($queue->getPeriodicAnnounceFrequency())
            ->setAnnouncePosition($queue->getAnnouncePosition())
            ->setAnnounceFrequency($queue->getAnnounceFrequency())
            ->setStrategy($queue->getStrategy())
            ->setTimeout($queue->getMemberCallTimeout())
            ->setWrapuptime($queue->getMemberCallRest())
            ->setWeight($queue->getWeight())
            ->setMaxlen($queue->getMaxlen());

        $this->entityTools->persistDto($astQueueDto, $astQueue);
    }
}
