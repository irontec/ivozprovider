<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Trusted\TrustedInterface;

interface TrustedLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TrustedInterface $entity);
}