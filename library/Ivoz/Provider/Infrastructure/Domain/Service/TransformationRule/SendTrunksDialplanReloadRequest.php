<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRule;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\XmlRpcTrunksRequest;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Ivoz\Provider\Domain\Service\TransformationRule\TransformationRuleLifecycleEventHandlerInterface;

class SendTrunksDialplanReloadRequest implements TransformationRuleLifecycleEventHandlerInterface
{
    protected $trunksDialplanReload;

    public function __construct(
        XmlRpcTrunksRequest $trunksDialplanReload
    ) {
        $this->trunksDialplanReload = $trunksDialplanReload;
    }

    public function execute(TransformationRuleInterface $entity, $isNew)
    {
        $this->trunksDialplanReload->send();
    }
}