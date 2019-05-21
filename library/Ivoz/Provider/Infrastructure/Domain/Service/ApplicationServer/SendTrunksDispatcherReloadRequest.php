<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;

class SendTrunksDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    protected $trunksGearmanClient;

    public function __construct(
        TrunksClientInterface $trunksGearmanClient
    ) {
        $this->trunksGearmanClient = $trunksGearmanClient;
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
    public function execute(ApplicationServerInterface $entity)
    {
        $this->trunksGearmanClient->reloadDispatcher();
    }
}
