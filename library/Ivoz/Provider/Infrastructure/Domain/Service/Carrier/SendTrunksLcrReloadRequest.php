<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Carrier;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequestInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements CarrierLifecycleEventHandlerInterface
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

    public function execute(CarrierInterface $entity)
    {
        $this->trunksLcrReload->send();
    }
}
