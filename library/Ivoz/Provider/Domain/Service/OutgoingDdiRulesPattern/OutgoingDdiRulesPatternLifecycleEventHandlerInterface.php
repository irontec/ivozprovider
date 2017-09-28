<?php

namespace Ivoz\Provider\Domain\Service\OutgoingDdiRulesPattern;

use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;

interface OutgoingDdiRulesPatternLifecycleEventHandlerInterface
{
    public function execute(OutgoingDdiRulesPatternInterface $entity);
}