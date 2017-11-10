<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeerServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements PeerServerLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(PeerServerInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}