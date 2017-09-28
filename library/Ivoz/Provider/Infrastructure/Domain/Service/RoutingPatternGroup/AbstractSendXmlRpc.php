<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksLcrReload;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\RoutingPatternGroupLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements RoutingPatternGroupLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        RequestProxyTrunksLcrReload $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(RoutingPatternGroupInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}