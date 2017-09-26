<?php

namespace Ivoz\Provider\Domain\Service\MatchListPattern;

use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;

interface MatchListPatternLifecycleEventHandlerInterface
{
    public function execute(MatchListPatternInterface $entity, $isNew);
}