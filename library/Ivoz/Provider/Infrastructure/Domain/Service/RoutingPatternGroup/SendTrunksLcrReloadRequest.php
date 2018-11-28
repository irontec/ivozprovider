<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequestInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\RoutingPatternGroupLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements RoutingPatternGroupLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequestInterface $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(RoutingPatternGroupInterface $entity)
    {
        $this->trunksLcrReload->send();
    }
}
