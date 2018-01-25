<?php

namespace Ivoz\Provider\Domain\Model\User;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UserRepository extends ObjectRepository, Selectable
{
    /**
     * @param UserInterface $user
     * @return UserInterface[]
     */
    public function getUserAssistantCandidates(UserInterface $user);
}

