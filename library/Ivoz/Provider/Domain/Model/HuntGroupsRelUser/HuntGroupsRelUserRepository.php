<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface HuntGroupsRelUserRepository extends ObjectRepository, Selectable
{
    /**
     * @return int[]
     */
    public function findUserIdsInHuntGroup(int $huntGroupId): array;
}
