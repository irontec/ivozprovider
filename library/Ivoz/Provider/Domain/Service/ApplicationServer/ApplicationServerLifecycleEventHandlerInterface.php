<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

interface ApplicationServerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ApplicationServerInterface $entity, $isNew);
}