<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\User\UserInterface;

interface CallForwardSettingRepository extends ObjectRepository, Selectable
{
    /**
     * @param mixed $userId
     * @return int
     */
    public function countByUserId($userId) :int;

    /**
     * @param UserInterface $user
     * @return CallForwardSettingInterface[]
     */
    public function findAndJoinByUser(UserInterface $user) :array;
}
