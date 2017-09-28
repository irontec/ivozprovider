<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;

interface UserLifecycleEventHandlerInterface
{
    public function execute(UserInterface $entity, $isNew);
}