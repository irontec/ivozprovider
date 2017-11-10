<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\RoutingPatternGroupLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(RoutingPatternGroupInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}