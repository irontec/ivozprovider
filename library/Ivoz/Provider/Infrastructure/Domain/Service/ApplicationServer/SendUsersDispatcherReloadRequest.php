<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcUsersRequestInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;

class SendUsersDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    protected $usersDispatcherReload;

    public function __construct(
        XmlRpcUsersRequestInterface $usersDispatcherReload
    ) {
        $this->usersDispatcherReload = $usersDispatcherReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(ApplicationServerInterface $entity)
    {
        $this->usersDispatcherReload->send();
    }
}
