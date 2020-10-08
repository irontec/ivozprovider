<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class AdminLoginChecker implements UserCheckerInterface
{
    public function checkPreAuth(SymfonyUserInterface $admin)
    {
        if (!$admin instanceof AdministratorInterface) {
            return;
        }

        if (!$admin->isEnabled()) {
            throw new CustomUserMessageAccountStatusException(
                'Your admin account is disabled.'
            );
        }
    }

    public function checkPostAuth(SymfonyUserInterface $user)
    {
    }
}