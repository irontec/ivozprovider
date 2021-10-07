<?php

namespace Ivoz\Kam\Domain\Service\Dispatcher;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher as KamDispatcher;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository as KamDispatcherRepository;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;

/**
 * Class UpdateByApplicationServer
 * @package Ivoz\Kam\Domain\Service\Dispatcher
 * @lifecycle post_persist
 */
class UpdateByApplicationServer implements ApplicationServerLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityPersisterInterface $entityPersister,
        private KamDispatcherRepository $dispatcherRepository
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
    public function execute(ApplicationServerInterface $entity)
    {
        /**
         * Replicate ApplicationServer IP into kam_dispatcher
         * @var KamDispatcher $kamDispatcher
         */
        $kamDispatcher = $this->dispatcherRepository->findOneByApplicationServerId(
            $entity->getId()
        );

        $kamDispatcherDto = $entity->isNew()
            ? KamDispatcher::createDto()
            : $kamDispatcher->toDto();

        $kamDispatcherDto
            ->setApplicationServerId($entity->getId())
            ->setSetid(1)
            ->setDestination('sip:' . $entity->getIp() . ":6060")
            ->setDescription($entity->getName());

        $this->entityPersister->persistDto($kamDispatcherDto, $kamDispatcher);
    }
}
