<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\OutgoingRouting;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReload;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements OutgoingRoutingLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        RequestProxyTrunksLcrReload $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(OutgoingRoutingInterface $entity)
    {
        $this->trunksLcrReload->send();
    }
}