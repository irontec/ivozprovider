<?php

namespace Ivoz\Provider\Domain\Model\FaxesRelUser;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * @extends RepositoryInterface<FaxesRelUserInterface, FaxesRelUserDto>
 */
interface FaxesRelUserRepository extends RepositoryInterface
{
    /** @return int[] */
    public function getFaxesIdsByUser(UserInterface $user): array;
}
