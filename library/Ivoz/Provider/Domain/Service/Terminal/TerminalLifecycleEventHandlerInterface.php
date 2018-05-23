<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

interface TerminalLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TerminalInterface $entity, $isNew);
}