<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressInterface;

interface BannedAddressLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(BannedAddressInterface $entity): void;
}
