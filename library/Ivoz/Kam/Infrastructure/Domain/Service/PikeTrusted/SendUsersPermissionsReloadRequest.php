<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;
use Ivoz\Kam\Domain\Service\PikeTrusted\PikeTrustedLifecycleEventHandlerInterface;

class SendUsersPermissionsReloadRequest implements PikeTrustedLifecycleEventHandlerInterface
{
    protected $usersPermissionsReload;

    public function __construct(
        XmlRpcUsersRequest $usersPermissionsReload
    ) {
        $this->usersPermissionsReload = $usersPermissionsReload;
    }

    public function execute(PikeTrustedInterface $entity)
    {
        $this->usersPermissionsReload->send();
    }
}