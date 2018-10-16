<?php

namespace Ivoz\Provider\Domain\Model\User;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface UserRepository extends ObjectRepository, Selectable
{
    /**
     * @param $id
     * @return UserInterface[]
     */
    public function findByBossAssistantId($id);

    /**
     * @param AdministratorInterface $admin
     * @return array
     *
     * @deprecated dead code
     */
    public function getSupervisedUserIdsByAdmin(AdministratorInterface $admin);

    /**
     * @param UserInterface $user
     * @return UserInterface[]
     */
    public function getUserAssistantCandidates(UserInterface $user) :array;

    /**
     * @param UserInterface $user
     * @return UserInterface[]
     */
    public function getAvailableVoicemails(UserInterface $user) :array;
}
