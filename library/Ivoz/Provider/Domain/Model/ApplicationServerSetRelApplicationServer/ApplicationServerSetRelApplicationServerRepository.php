<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<ApplicationServerSetRelApplicationServerInterface, ApplicationServerSetRelApplicationServerDto>
 */
interface ApplicationServerSetRelApplicationServerRepository extends RepositoryInterface
{
    /**
     * @return ApplicationServerSetRelApplicationServerInterface[]
     */
    public function findByApplicationServerId(int $applicationServerId): array;
}
