<?php

namespace Ivoz\Kam\Domain\Service\Dispatcher;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher as KamDispatcher;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherInterface;
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

    public function execute(ApplicationServerInterface $applicationServer): void
    {
        if ($applicationServer->isNew()) {
            return;
        }

        $kamDispatchers = $this->dispatcherRepository->findByApplicationServerId(
            (int) $applicationServer->getId()
        );

        foreach ($kamDispatchers as $kamDispatcher) {
            $this->updateDispatcher(
                $applicationServer,
                $kamDispatcher,
            );
        }
    }

    private function updateDispatcher(
        ApplicationServerInterface $applicationServer,
        DispatcherInterface $kamDispatcher
    ): void {
        $kamDispatcherDto = $kamDispatcher->toDto();

        $kamDispatcherDto
            ->setDestination('sip:' . $applicationServer->getIp() . ":6060")
            ->setDescription($applicationServer->getName());

        $this->entityPersister->persistDto($kamDispatcherDto, $kamDispatcher);
    }
}
