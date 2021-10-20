<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;

class SendUsersPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_HIGH;

    public function __construct(
        private UsersClientInterface $usersClient
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
    public function execute(TrustedInterface $trusted)
    {
        $this->usersClient->reloadTrustedPermissions();
    }
}
