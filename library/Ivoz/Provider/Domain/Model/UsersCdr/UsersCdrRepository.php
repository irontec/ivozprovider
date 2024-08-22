<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<UsersCdrInterface, UsersCdrDto>
 */
interface UsersCdrRepository extends RepositoryInterface
{
    public function findByKamUsersCdrId(int $id): ?UsersCdrInterface;

    /**
     * @return UsersCdrInterface[]
     */
    public function findByCallid(string $callid);
}
