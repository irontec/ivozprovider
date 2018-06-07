<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;

class SendTrunksDispatcherReloadRequest implements ApplicationServerLifecycleEventHandlerInterface
{
    protected $trunksDispatcherReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksDispatcherReload
    ) {
        $this->trunksDispatcherReload = $trunksDispatcherReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 20
        ];
    }

    public function execute(ApplicationServerInterface $entity, $isNew)
    {
        $this->trunksDispatcherReload->send();
    }
}