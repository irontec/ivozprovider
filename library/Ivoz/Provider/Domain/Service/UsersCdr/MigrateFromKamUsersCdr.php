<?php

namespace Ivoz\Provider\Domain\Service\UsersCdr;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface as KamUsersCdrInterface;
use Ivoz\Kam\Domain\Service\UsersCdr\SetParsed;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrRepository as ProviderUsersCdrRepository;

class MigrateFromKamUsersCdr
{
    public function __construct(
        private ProviderUsersCdrRepository $providerUsersCdrRepository,
        private SetParsed $setParsed,
        private EntityTools $entityTools
    ) {
    }

    public function execute(KamUsersCdrInterface $usersCdr, bool $dispatchImmediately = false): void
    {
        throw new \Exception("TODO");
    }
}
