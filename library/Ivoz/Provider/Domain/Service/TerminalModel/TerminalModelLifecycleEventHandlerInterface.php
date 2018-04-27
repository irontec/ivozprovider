<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;

interface TerminalModelLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TerminalModelInterface $entity, $isNew);
}