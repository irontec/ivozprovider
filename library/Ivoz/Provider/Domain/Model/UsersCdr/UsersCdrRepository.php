<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<UsersCdrInterface, UsersCdrDto>
 */
interface UsersCdrRepository extends RepositoryInterface
{
    public function findByKamUsersCdrId(int $id): ?UsersCdrInterface;

    public function findLastByCallid(string $callid): ?UsersCdrInterface;
}
