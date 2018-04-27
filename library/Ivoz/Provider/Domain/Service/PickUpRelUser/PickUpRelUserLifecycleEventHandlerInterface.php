<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;

interface PickUpRelUserLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(PickUpRelUserInterface $entity, $isNew);
}