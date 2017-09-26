<?php

namespace Ivoz\Provider\Infrastructure\Domain\Service\TransformationRulesetGroupsTrunk;

use Ivoz\Core\Infrastructure\Domain\Service\XmlRpc\RequestProxyTrunksDialplanReload;
use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;
use Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk\PickUpRelUserLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface;

abstract class AbstractSendXmlRpc implements TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface
{
    protected $trunksDialplanReload;

    public function __construct(
        RequestProxyTrunksDialplanReload $trunksDialplanReload
    ) {
        $this->trunksDialplanReload = $trunksDialplanReload;
    }

    public function execute(TransformationRulesetGroupsTrunkInterface $entity, $isNew)
    {
        $this->trunksDialplanReload->send();
    }
}