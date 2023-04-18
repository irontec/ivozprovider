<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface QueueMemberRepository extends ObjectRepository, Selectable
{
    /**
     * @return array<QueueMemberInterface>
     */
    public function findByUserId(int $userId): array;

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByQueueAndExtension(int $queueid, int $extension): ?QueueMemberInterface;
}
