<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

interface TransformationRuleSetLifecycleEventHandlerInterface
{
    public function execute(TransformationRuleSetInterface $entity, $isNew);
}