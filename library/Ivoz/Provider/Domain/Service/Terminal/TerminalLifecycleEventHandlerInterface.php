<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

interface TerminalLifecycleEventHandlerInterface
{
    public function execute(TerminalInterface $entity, $isNew);
}