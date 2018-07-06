<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\Carrier;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class SendTrunksUacRegReloadRequest implements CarrierLifecycleEventHandlerInterface
{
    protected $trunksUacRegReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksUacRegReload
    ) {
        $this->trunksUacRegReload = $trunksUacRegReload;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 20
        ];
    }

    public function execute(CarrierInterface $entity, $isNew)
    {
        $this->trunksUacRegReload->send();
    }
}