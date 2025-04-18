<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

class SendTrunksDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private TrunksClientInterface $trunksClient,
        private DispatcherRepository $dispatcherRepository,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(ApplicationServerInterface $applicationServer)
    {
        if ($applicationServer->isNew()) {
            return;
        }

        if ($applicationServer->hasBeenDeleted()) {
            return;
        }

        $updatedAddress = $applicationServer->hasChanged('ip');
        if (!$updatedAddress) {
            return;
        }

        $dispatchers = $this->dispatcherRepository
            ->findByApplicationServerId(
                $applicationServer->getId() ?? -1
            );

        if (empty($dispatchers)) {
            return;
        }

        $this->trunksClient->reloadDispatcher();
    }
}
