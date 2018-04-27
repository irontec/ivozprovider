<?php

namespace Ivoz\Kam\Domain\Service\Dispatcher;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher as KamDispatcher;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository as KamDispatcherRepository;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

/**
 * Class UpdateByApplicationServer
 * @package Ivoz\Kam\Domain\Service\Dispatcher
 * @lifecycle post_persist
 */
class UpdateByApplicationServer implements ApplicationServerLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var KamDispatcherRepository
     */
    protected $dispatcherRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        KamDispatcherRepository $dispatcherRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->dispatcherRepository = $dispatcherRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(ApplicationServerInterface $entity, $isNew)
    {
        /**
         * Replicate ApplicationServer IP into kam_dispatcher
         * @var KamDispatcher $kamDispatcher
         */
        $kamDispatcher = $this->dispatcherRepository->findOneBy([
            'applicationServer' => $entity->getId()
        ]);

        $kamDispatcherDto = $isNew
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