<?php

namespace Ivoz\Provider\Domain\Service\TransformationRulesetGroupsTrunk;

use Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface;

interface TransformationRulesetGroupsTrunkLifecycleEventHandlerInterface
{
    public function execute(TransformationRulesetGroupsTrunkInterface $entity, $isNew);
}