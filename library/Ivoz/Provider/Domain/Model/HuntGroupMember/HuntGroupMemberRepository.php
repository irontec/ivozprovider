<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupMember;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface HuntGroupMemberRepository extends ObjectRepository, Selectable
{
    /**
     * @return array<int>
     */
    public function findUserIdsInHuntGroup(int $huntGroupId): array;
}
