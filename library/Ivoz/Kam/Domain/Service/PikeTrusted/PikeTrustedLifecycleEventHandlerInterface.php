<?php

namespace Ivoz\Kam\Domain\Service\PikeTrusted;

use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrustedInterface;

interface PikeTrustedLifecycleEventHandlerInterface
{
    public function execute(PikeTrustedInterface $entity);
}