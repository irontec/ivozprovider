<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserLoginChecker implements UserCheckerInterface
{
    public function checkPreAuth(SymfonyUserInterface $admin)
    {
        if (
            !$admin instanceof UserInterface
            && !$admin instanceof AdministratorInterface
        ) {
            return;
        }

        if (!$admin->isEnabled()) {
            throw new CustomUserMessageAccountStatusException(
                'Your user account was disabled.'
            );
        }
    }

    public function checkPostAuth(SymfonyUserInterface $user)
    {
    }
}