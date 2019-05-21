<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\UsersAddress;

use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;
use Ivoz\Kam\Domain\Service\UsersAddress\UsersAddressLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;

class SendUsersPermissionsReloadRequest implements UsersAddressLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    protected $usersClient;

    public function __construct(
        UsersClientInterface $usersClient
    ) {
        $this->usersClient = $usersClient;
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
    public function execute(UsersAddressInterface $entity)
    {
        $this->usersClient->reloadAddressPermissions();
    }
}
