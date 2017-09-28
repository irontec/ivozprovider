<?php

namespace Ivoz\Kam\Domain\Service\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

interface TrunksUacregLifecycleEventHandlerInterface
{
    public function execute(TrunksUacregInterface $entity, $isNew);
}