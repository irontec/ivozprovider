<?php

namespace Ivoz\Provider\Domain\Service\QueueMember;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;

interface QueueMemberLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(QueueMemberInterface $queueMember): void;
}
