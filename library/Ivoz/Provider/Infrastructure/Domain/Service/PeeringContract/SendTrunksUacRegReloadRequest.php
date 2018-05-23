<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeeringContract;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Service\PeeringContract\PeeringContractLifecycleEventHandlerInterface;

class SendTrunksUacRegReloadRequest implements PeeringContractLifecycleEventHandlerInterface
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

    public function execute(PeeringContractInterface $entity, $isNew)
    {
        $this->trunksUacRegReload->send();
    }
}