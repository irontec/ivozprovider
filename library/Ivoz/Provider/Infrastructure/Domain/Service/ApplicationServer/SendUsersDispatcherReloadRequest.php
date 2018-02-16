<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequest;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;

class SendUsersDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    protected $usersDispatcherReload;

    public function __construct(
        XmlRpcUsersRequest $usersDispatcherReload
    ) {
        $this->usersDispatcherReload = $usersDispatcherReload;
    }

    public function execute(ApplicationServerInterface $entity, $isNew)
    {
        $this->usersDispatcherReload->send();
    }
}