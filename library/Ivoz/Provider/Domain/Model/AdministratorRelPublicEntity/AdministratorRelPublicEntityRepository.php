<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Doctrine\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface AdministratorRelPublicEntityRepository extends ObjectRepository, Selectable
{
    public function setWritePermissions(AdministratorInterface $administrator): int;

    /**
     * @param int[] $ids
     */
    public function setWritePermissionsByIds(array $ids): int;

    public function setReadOnlyPermissions(AdministratorInterface $administrator): int;

    /**
     * @param int[] $ids
     */
    public function setReadOnlyPermissionsByIds(array $ids): int;

    /**
     * @param int[] $ids
     */
    public function revokePermissionsByIds(array $ids): int;

    public function removeByAdministratorId(int $id): int;

    /**
     * @return AdministratorRelPublicEntityInterface[]
     */
    public function getByAdministratorId(int $id): array;
}
