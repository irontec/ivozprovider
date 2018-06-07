<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;

interface UsersAddressLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(UsersAddressInterface $entity);
}