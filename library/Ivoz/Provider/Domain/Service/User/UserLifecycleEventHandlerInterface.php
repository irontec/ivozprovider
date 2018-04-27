<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

interface UserLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(UserInterface $entity, $isNew);
}