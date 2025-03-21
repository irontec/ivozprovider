<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

interface ApplicationServerSetLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ApplicationServerSetInterface $applicationServerSet): void;
}
