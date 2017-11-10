<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\PeeringContract;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Service\PeeringContract\PeeringContractLifecycleEventHandlerInterface;

class SendTrunksLcrReloadRequest implements PeeringContractLifecycleEventHandlerInterface
{
    protected $trunksLcrReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksLcrReload
    ) {
        $this->trunksLcrReload = $trunksLcrReload;
    }

    public function execute(PeeringContractInterface $entity, $isNew)
    {
        $this->trunksLcrReload->send();
    }
}