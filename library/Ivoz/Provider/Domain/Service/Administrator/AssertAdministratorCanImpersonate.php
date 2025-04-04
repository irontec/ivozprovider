<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;

class AssertAdministratorCanImpersonate
{
    public function __construct(
        private AdministratorRepository $administratorRepository,
        private UserRepository $userRepository
    ) {
    }

    public function execute(
        int $originatorAdminId,
        AdministratorInterface | UserInterface $target
    ): void {
        $this->validateOriginatorAdmin($originatorAdminId);

        if ($target instanceof AdministratorInterface) {
            $this->validateTargetAdmin($target);
        }

        if ($target instanceof UserInterface) {
            $this->validateTargetUser($target);
        }
    }

    private function validateTargetAdmin(
        AdministratorInterface $targetAdmin
    ): void {
        /** @var AdministratorInterface|null $administrator */
        $administrator = $this->administratorRepository
            ->find(
                $targetAdmin->getId()
            );

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

    private function validateTargetUser(
        UserInterface $targetUser
    ): void {
        $user = $this->userRepository->find($targetUser->getId());

        if ($user === null) {
            throw new \DomainException(
                'Admin not found',
                404
            );
        }

        if ($user->getActive()) {
            return;
        }

        throw new \DomainException(
            'Cannot impersonate inactive user',
            401
        );
    }

    private function validateOriginatorAdmin(int $originatorAdminId): void
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
