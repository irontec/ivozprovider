<?php

namespace Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface PsEndpointLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(PsEndpointInterface $psEndpoint): void;
}
