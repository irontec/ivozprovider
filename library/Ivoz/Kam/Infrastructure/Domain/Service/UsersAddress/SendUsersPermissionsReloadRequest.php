<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\UsersAddress;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;
use Ivoz\Kam\Domain\Service\UsersAddress\UsersAddressLifecycleEventHandlerInterface;

class SendUsersPermissionsReloadRequest implements UsersAddressLifecycleEventHandlerInterface
{
    protected $usersPermissionsReload;

    public function __construct(
        XmlRpcUsersRequest $usersPermissionsReload
    ) {
        $this->usersPermissionsReload = $usersPermissionsReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(UsersAddressInterface $entity)
    {
        $this->usersPermissionsReload->send();
    }
}