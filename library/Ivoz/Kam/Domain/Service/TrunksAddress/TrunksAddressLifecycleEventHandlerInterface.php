<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface;

interface TrunksAddressLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TrunksAddressInterface $trunksAddress);
}
