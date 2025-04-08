<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

/**
 * @extends RepositoryInterface<UserInterface, UserDto>
 */
interface UserRepository extends RepositoryInterface
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

    public function findOneByTerminalId(
        ?int $terminalId
    ): ?UserInterface;

    public function findOneByExtensionId(
        ?int $extensionId
    ): ?UserInterface;

    /**
     * @param array<string, mixed> $criteria
     */
    public function count(array $criteria): int;

    /**
     * @return UserInterface[]
     */
    public function findLatestAddedByCompany(int $companyId): array;

    /**
     * @return UserInterface[]
     */
    public function findByCompanyUsingDefaultLocation(int $companyId): array;
}
