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
    public function execute(ApplicationServerInterface $applicationServer)
    {
        /**
         * Replicate ApplicationServer IP into kam_dispatcher
         * @var KamDispatcher $kamDispatcher
         */
        $kamDispatcher = $this->dispatcherRepository->findOneByApplicationServerId(
            (int) $applicationServer->getId()
        );

        $kamDispatcherDto = $applicationServer->isNew()
            ? KamDispatcher::createDto()
            : $kamDispatcher->toDto();

        $kamDispatcherDto
            ->setApplicationServerId($applicationServer->getId())
            ->setSetid(1)
            ->setDestination('sip:' . $applicationServer->getIp() . ":6060")
            ->setDescription($applicationServer->getName());

        $this->entityPersister->persistDto($kamDispatcherDto, $kamDispatcher);
    }
}
