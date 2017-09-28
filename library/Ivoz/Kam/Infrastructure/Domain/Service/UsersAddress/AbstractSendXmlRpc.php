<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\UsersAddress;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersAddresReload;
use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersPermissionsAddressReload;
use Ivoz\Kam\Domain\Model\UsersAddres\UsersAddresInterface;
use Ivoz\Kam\Domain\Service\UsersAddres\UsersAddresLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements UsersAddresLifecycleEventHandlerInterface
{
    /**
     * @var RequestProxyUsersPermissionsAddressReload
     */
    protected $usersPermissionsAddressReload;

    public function __construct(
        RequestProxyUsersPermissionsAddressReload $usersPermissionsAddressReload
    ) {
        $this->usersPermissionsAddressReload = $usersPermissionsAddressReload;
    }

    public function execute(UsersAddresInterface $entity)
    {
        $this->usersPermissionsAddressReload->send();
    }
}