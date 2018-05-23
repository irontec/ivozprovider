<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPattern;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPattern\RoutingPatternLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}