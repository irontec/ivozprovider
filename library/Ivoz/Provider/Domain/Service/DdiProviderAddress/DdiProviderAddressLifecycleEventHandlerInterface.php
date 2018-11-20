<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderAddress;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

interface DdiProviderAddressLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(DdiProviderAddressInterface $entity);
}
