<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

interface FriendLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FriendInterface $entity, $isNew);
}