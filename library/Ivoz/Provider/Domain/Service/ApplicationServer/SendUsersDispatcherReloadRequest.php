<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

class SendUsersDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_HIGH;

    protected $usersGearmanClient;

    public function __construct(
        UsersClientInterface $usersGearmanClient
    ) {
        $this->usersGearmanClient = $usersGearmanClient;
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
        $this->usersGearmanClient->reloadDispatcher();
    }
}
