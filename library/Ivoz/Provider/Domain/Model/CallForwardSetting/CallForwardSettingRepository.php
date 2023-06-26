<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Doctrine\ORM\QueryBuilder;

interface CallForwardSettingRepository extends ObjectRepository, Selectable
{
    /**
     * @param mixed $userId
     */
    public function countByUserId($userId): int;

    /**
     * @return CallForwardSettingInterface[]
     */
    public function findAndJoinByUser(UserInterface $user): array;

    public function prepareAndJoinByUser(UserInterface $user): QueryBuilder;
}
