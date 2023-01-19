<?php

namespace Service\AdministratorRelPublicEntity;

use Ivoz\Provider\Infrastructure\Persistence\Doctrine\AdministratorRelPublicEntityDoctrineRepository;

class SwitchAcl
{
    public const ACL_GRANT_READ_ONLY = 'grant_read_only';
    public const ACL_GRANT_ALL = 'grant_all';
    public const ACL_REVOKE_ALL = 'revoke_all';

    public function __construct(
        private AdministratorRelPublicEntityDoctrineRepository $administratorRelPublicEntityDoctrineRepository
    ) {
    }

    /**
     * @param int[] $publicEntitiesRelUserIds
     */
    public function execute(
        int $adminId,
        array $publicEntitiesRelUserIds,
        string $operation
    ): void {

        match ($operation) {
            self::ACL_GRANT_ALL => $this->grantAll($adminId, $publicEntitiesRelUserIds),
            self::ACL_GRANT_READ_ONLY => $this->grantReadOnly($adminId, $publicEntitiesRelUserIds),
            self::ACL_REVOKE_ALL => $this->revokeAll($adminId, $publicEntitiesRelUserIds),
            default => throw new \UnhandledMatchError('No matching route found', 404),
        };
    }

    /**
     * @param int[] $publicEntitiesRelUserIds
     * @throws \Exception
     */
    private function grantAll(int $adminId, array $publicEntitiesRelUserIds): void
    {
        $this
            ->administratorRelPublicEntityDoctrineRepository
            ->grantAllPermissionsByAdministratorAndIds($adminId, $publicEntitiesRelUserIds);
    }

    /**
     * @param int[] $publicEntitiesRelUserIds
     * @throws \Exception
     */
    private function grantReadOnly(int $adminId, array $publicEntitiesRelUserIds): void
    {
        $this
            ->administratorRelPublicEntityDoctrineRepository
            ->grantReadOnlyPermissionsByAdministratorAndIds($adminId, $publicEntitiesRelUserIds);
    }

    /**
     * @param int[] $publicEntitiesRelUserIds
     * @throws \Exception
     */
    private function revokeAll(int $adminId, array $publicEntitiesRelUserIds): void
    {
        $this
            ->administratorRelPublicEntityDoctrineRepository
            ->revokeAllPermissionsByAdministratorAndIds($adminId, $publicEntitiesRelUserIds);
    }
}
