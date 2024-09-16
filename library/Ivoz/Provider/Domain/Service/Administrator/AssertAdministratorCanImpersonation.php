<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;

class AssertAdministratorCanImpersonation
{
    public function __construct(
        private AdministratorRepository $administratorRepository
    ) {
    }

    public function execute(int $originatorAdminId, int $targetAdminId): void
    {
        $this->validateOriginatorAdmin($originatorAdminId);
        $this->validateTargetAdmin($targetAdminId);
    }

    private function validateTargetAdmin(int $targetAdminId): void
    {
        /** @var AdministratorInterface|null $administrator */
        $administrator = $this->administratorRepository->find($targetAdminId);

        if ($administrator === null) {
            throw new \DomainException(
                'Admin not found',
                404
            );
        }

        if ($administrator->getInternal()) {
            return;
        }

        if ($administrator->isEnabled()) {
            return;
        }

        throw new \DomainException(
            'Admin cannot be impersonated',
            401
        );
    }

    public function validateOriginatorAdmin(int $originatorAdminId): void
    {
        /** @var AdministratorInterface|null $administrator */
        $administrator = $this->administratorRepository->find($originatorAdminId);

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
