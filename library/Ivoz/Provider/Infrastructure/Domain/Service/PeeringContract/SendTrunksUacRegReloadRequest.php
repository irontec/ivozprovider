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

    public function execute(PeeringContractInterface $entity, $isNew)
    {
        $this->trunksUacRegReload->send();
    }
}