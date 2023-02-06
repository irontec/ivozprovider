<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;

class SendUsersPermissionsReloadRequest implements UsersAddressLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

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
    public function execute(UsersAddressInterface $usersAddress)
    {
        $this->usersClient->reloadAddressPermissions();
    }
}
