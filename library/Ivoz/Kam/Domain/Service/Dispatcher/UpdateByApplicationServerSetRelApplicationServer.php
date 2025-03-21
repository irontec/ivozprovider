<?php

namespace Ivoz\Kam\Domain\Service\Dispatcher;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher as KamDispatcher;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository as KamDispatcherRepository;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface;

/**
 * Class UpdateByApplicationServerSetRelApplicationServer
 * @package Ivoz\Kam\Domain\Service\Dispatcher
 * @lifecycle post_persist
 */
class UpdateByApplicationServerSetRelApplicationServer implements ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface
{
    protected const POST_PERSIST_PRIORITY = 10;

    public function __construct(
        private EntityTools $entityTools,
        private KamDispatcherRepository $dispatcherRepository
    ) {
    }

    /** @return array<string,int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    public function execute(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): void
    {
        if (!$relApplicationServer->isNew()) {
            return;
        }
        /**
         * Replicate ApplicationServer IP into kam_dispatcher
         * @var KamDispatcher $kamDispatcher
         */
        $kamDispatcher = $this->dispatcherRepository->findOneByApplicationServerSetRelApplicationServer(
            (int) $relApplicationServer->getId()
        );

        $applicationServer = $relApplicationServer->getApplicationServer();
        /** @var ApplicationServerSet $applicationServerSet */
        $applicationServerSet = $relApplicationServer->getApplicationServerSet();

        $kamDispatcherDto = $relApplicationServer->isNew()
            ? KamDispatcher::createDto()
            : $kamDispatcher->toDto();

        $dispatcherDestination = sprintf('sip:%s:6060', $applicationServer->getIp());
        $kamDispatcherDto
            ->setSetid((int)$applicationServerSet->getId())
            ->setDestination($dispatcherDestination)
            ->setDescription($applicationServer->getName())
            ->setApplicationServerSetRelApplicationServerId(
                (int) $relApplicationServer->getId()
            );

        $this->entityTools->persistDto(
            $kamDispatcherDto,
        );
    }
}
