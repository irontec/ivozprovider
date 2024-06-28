<?php

namespace Ivoz\Provider\Domain\Model\VoicemailRelUser;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * @extends RepositoryInterface<VoicemailRelUserInterface, VoicemailRelUserDto>
 */
interface VoicemailRelUserRepository extends RepositoryInterface
{
    /**
     * @return int[]
     */
    public function getVoicemailIdsByUser(UserInterface $user): array;
}
