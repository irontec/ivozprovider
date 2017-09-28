<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;

interface PickUpRelUserLifecycleEventHandlerInterface
{
    public function execute(PickUpRelUserInterface $entity, $isNew);
}