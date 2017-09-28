<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeerServer;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReload;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PickUpRelUserLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements PeerServerLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        RequestProxyTrunksLcrReload $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(PeerServerInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}