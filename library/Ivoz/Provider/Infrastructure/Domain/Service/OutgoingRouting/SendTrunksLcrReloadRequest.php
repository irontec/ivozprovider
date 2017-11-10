<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\OutgoingRouting;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements OutgoingRoutingLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(OutgoingRoutingInterface $entity)
    {
        $this->trunksLcrReload->send();
    }
}