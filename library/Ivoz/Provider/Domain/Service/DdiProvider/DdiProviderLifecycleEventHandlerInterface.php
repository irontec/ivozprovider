<?php

namespace Ivoz\Provider\Domain\Service\DdiProvider;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;

interface DdiProviderLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DdiProviderInterface $ddiProvider);
}
