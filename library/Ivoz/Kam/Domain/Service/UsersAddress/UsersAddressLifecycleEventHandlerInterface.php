<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddressInterface;

interface UsersAddressLifecycleEventHandlerInterface
{
    public function execute(UsersAddressInterface $entity);
}