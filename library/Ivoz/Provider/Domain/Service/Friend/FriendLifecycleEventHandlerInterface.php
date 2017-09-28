<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

interface FriendLifecycleEventHandlerInterface
{
    public function execute(FriendInterface $entity, $isNew);
}