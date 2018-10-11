<?php

namespace Ivoz\Provider\Domain\Service\HuntGroupsRelUser;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;

interface HuntGroupsRelUserLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(HuntGroupsRelUserInterface $entity);
}
