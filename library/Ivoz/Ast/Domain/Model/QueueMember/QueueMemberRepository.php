<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface QueueMemberRepository extends ObjectRepository, Selectable
{
    public function findOneByProviderQueueMemberId(int $queueMemberId): ?QueueMemberInterface;
}
