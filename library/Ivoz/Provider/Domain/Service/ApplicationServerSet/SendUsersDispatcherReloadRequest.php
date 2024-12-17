<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

class SendUsersDispatcherReloadRequest implements ApplicationServerSetLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_LOW;

    public function __construct(
        private UsersClientInterface $usersClient,
    ) {
    }

    /** @return array<string, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function execute(ApplicationServerSetInterface $applicationServerSet): void
    {
        $mustReloadDispatcher = $applicationServerSet->hasBeenDeleted();
        if (!$mustReloadDispatcher) {
            return;
        }

        $this->usersClient->reloadDispatcher();
    }
}
