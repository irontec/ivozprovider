<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

interface DdiLifecycleEventHandlerInterface
{
    public function execute(DdiInterface $entity, $isNew);
}