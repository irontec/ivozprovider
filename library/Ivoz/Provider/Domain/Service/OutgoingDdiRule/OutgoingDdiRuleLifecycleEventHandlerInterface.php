<?php

namespace Ivoz\Provider\Domain\Service\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;

interface OutgoingDdiRuleLifecycleEventHandlerInterface
{
    public function execute(OutgoingDdiRuleInterface $entity);
}