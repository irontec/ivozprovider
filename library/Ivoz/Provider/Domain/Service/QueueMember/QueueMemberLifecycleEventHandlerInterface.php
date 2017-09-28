<?php

namespace Ivoz\Provider\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;

interface QueueMemberLifecycleEventHandlerInterface
{
    public function execute(QueueMemberInterface $entity, $isNew);
}