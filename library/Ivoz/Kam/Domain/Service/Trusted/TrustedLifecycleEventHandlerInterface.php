<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;

interface TrustedLifecycleEventHandlerInterface
{
    public function execute(TrustedInterface $entity);
}