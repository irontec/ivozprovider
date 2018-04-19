<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\Trusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;
use Ivoz\Kam\Domain\Service\Trusted\TrustedLifecycleEventHandlerInterface;

class SendUsersPermissionsReloadRequest implements TrustedLifecycleEventHandlerInterface
{
    protected $usersPermissionsReload;

    public function __construct(
        XmlRpcUsersRequest $usersPermissionsReload
    ) {
        $this->usersPermissionsReload = $usersPermissionsReload;
    }

    public function execute(TrustedInterface $entity)
    {
        $this->usersPermissionsReload->send();
    }
}