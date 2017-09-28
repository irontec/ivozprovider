<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanInterface;

interface TrunksDialplanLifecycleEventHandlerInterface
{
    public function execute(TrunksDialplanInterface $entity);
}