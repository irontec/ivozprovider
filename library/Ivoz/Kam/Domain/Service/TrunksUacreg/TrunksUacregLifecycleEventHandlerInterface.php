<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

interface TrunksUacregLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TrunksUacregInterface $entity, $isNew);
}