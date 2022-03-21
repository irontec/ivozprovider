<?php

namespace Ivoz\Provider\Domain\Model\User;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface UserRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return UserInterface[]
     */
    public function findByBossAssistantId($id);

    /**
     * Used by client API access controls
     * @param AdministratorInterface $admin
     * @return array
     */
    public function getSupervisedUserIdsByAdmin(AdministratorInterface $admin);

    /**
     * @param UserInterface $user
     * @return UserInterface[]
     */
    public function getUserAssistantCandidates(UserInterface $user): array;

    public function getBrandUsersIdsOrderByTerminalExpireDate(int $brandId, string $order = 'DESC'): array;

    /**
     * @return UserInterface | null
     */
    public function findOneByCompanyAndName(
        int $companyId,
        string $name,
        string $lastName
    );

    /**
     * @param int[] $excludeIds
     * @return UserInterface[]
     */
    public function findCompanyUsersExcludingIds(
        int $companyId,
        array $excludeIds
    ): array;

    /**
     * @return UserInterface | null
     */
    public function findOneByEmail(
        string $email
    );
}
