<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Service\TransformationRuleSet\TransformationRuleSetLifecycleEventHandlerInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleSetLifecycleEventHandlerInterface
{
    protected $trunksDialplanReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksDialplanReload
    ) {
        $this->trunksDialplanReload = $trunksDialplanReload;
    }

    public function execute(TransformationRuleSetInterface $entity, $isNew)
    {
        $this->trunksDialplanReload->send();
    }
}