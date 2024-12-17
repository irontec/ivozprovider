<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer;

use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;

class SendUsersDispatcherReloadRequest implements ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private UsersClientInterface $usersClient,
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): void
    {
        $mustReloadDispatcher = (
                $relApplicationServer->hasBeenDeleted()
                ||
                $relApplicationServer->isNew()
        );

        if (!$mustReloadDispatcher) {
            return;
        }

        $this->usersClient->reloadDispatcher();
    }
}
