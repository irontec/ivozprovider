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

    public function execute(int $id): void
    {
        /** @var AdministratorInterface|null $administrator */
        $administrator = $this->administratorRepository->find($id);

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
