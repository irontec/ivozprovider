<?php

namespace Ivoz\Provider\Domain\Service\Fax;

use Ivoz\Provider\Domain\Model\Fax\FaxInterface;

interface FaxLifecycleEventHandlerInterface
{
    public function execute(FaxInterface $entity, $isNew);
}