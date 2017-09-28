<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;

interface ApplicationServerLifecycleEventHandlerInterface
{
    public function execute(ApplicationServerInterface $entity, $isNew);
}