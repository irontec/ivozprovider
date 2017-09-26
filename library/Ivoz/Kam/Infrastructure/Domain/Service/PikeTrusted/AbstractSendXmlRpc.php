<?php

namespace Ivoz\Kam\Infrastructure\Domain\Service\PikeTrusted;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksPermissionsTrustedReload;
use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyUsersPermissionsTrustedReload;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;
use Ivoz\Kam\Domain\Service\PikeTrusted\PikeTrustedLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements PikeTrustedLifecycleEventHandlerInterface
{
    protected $usersPermissionsTrustedReload;
    protected $trunksPermissionsTrustedReload;

    public function __construct(
        RequestProxyUsersPermissionsTrustedReload $usersPermissionsTrustedReload,
        RequestProxyTrunksPermissionsTrustedReload $trunksPermissionsTrustedReload
    ) {
        $this->usersPermissionsTrustedReload = $usersPermissionsTrustedReload;
        $this->trunksPermissionsTrustedReload = $trunksPermissionsTrustedReload;
    }

    public function execute(PikeTrustedInterface $entity)
    {
        $this->usersPermissionsTrustedReload->send();
        $this->trunksPermissionsTrustedReload->send();
    }
}