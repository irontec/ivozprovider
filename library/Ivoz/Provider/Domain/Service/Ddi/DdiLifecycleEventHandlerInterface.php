<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

interface DdiLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DdiInterface $ddi): void;
}
