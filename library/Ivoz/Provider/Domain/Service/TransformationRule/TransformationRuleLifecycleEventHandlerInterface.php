<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

interface TransformationRuleLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TransformationRuleInterface $entity, $isNew);
}