<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;

interface TerminalModelLifecycleEventHandlerInterface
{
    public function execute(TerminalModelInterface $entity, $isNew);
}