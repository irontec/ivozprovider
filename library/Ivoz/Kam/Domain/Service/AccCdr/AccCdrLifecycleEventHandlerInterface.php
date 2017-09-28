<?php

namespace Ivoz\Kam\Domain\Service\AccCdr;

use Ivoz\Kam\Domain\Model\AccCdr\AccCdrInterface;

interface AccCdrLifecycleEventHandlerInterface
{
    public function execute(AccCdrInterface $entity);
}