<?php

namespace Ivoz\Provider\Domain\Service\ProxyUser;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserInterface;

interface ProxyUserLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(ProxyUserInterface $proxyUser);
}
