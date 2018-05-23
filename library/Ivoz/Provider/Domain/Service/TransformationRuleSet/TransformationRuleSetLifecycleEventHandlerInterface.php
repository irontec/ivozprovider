<?php

namespace Ivoz\Provider\Domain\Service\TransformationRuleSet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

interface TransformationRuleSetLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TransformationRuleSetInterface $entity, $isNew);
}