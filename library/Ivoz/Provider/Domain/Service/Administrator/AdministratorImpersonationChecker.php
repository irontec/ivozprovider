<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\AdministratorDoctrineRepository;

class AdministratorImpersonationChecker
{
    /** @var AdministratorRepository $administratorRepository */
    private AdministratorRepository $administratorRepository;

    public function __construct(
        AdministratorRepository $administratorRepository
    ) {
        $this->administratorRepository = $administratorRepository;
    }

    public function execute(?string $username): void
    {
        if ($username === null || $username === '') {
            return;
        }

        $administrator = $this->administratorRepository->findAdminByUsername($username);

        if ($administrator === null) {
            throw new \DomainException(
                'Admin not found',
                404
            );
        }
        if (!$administrator->getRestricted()) {
            return;
        }

        if ($administrator->getCanImpersonate()) {
            return;
        }

        throw new \DomainException(
            'Admin cannot impersonate',
            401
        );
    }
}
