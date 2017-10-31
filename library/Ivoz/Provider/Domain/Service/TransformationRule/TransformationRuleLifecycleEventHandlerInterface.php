<?php

namespace Ivoz\Provider\Domain\Service\TransformationRule;

use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;

interface TransformationRuleLifecycleEventHandlerInterface
{
    public function execute(TransformationRuleInterface $entity, $isNew);
}