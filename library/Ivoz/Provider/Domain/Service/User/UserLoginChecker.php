<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class UserLoginChecker implements UserCheckerInterface
{
    /**
     * @return void
     */
    public function checkPreAuth(SymfonyUserInterface $admin)
    {
        $isTargetClass =
            $admin instanceof UserInterface
            || $admin instanceof AdministratorInterface;

        if (!$isTargetClass) {
            return;
        }

        /** @var AdministratorInterface|UserInterface $admin */
        if (!$admin->isEnabled()) {
            throw new CustomUserMessageAccountStatusException(
                'Your user account was disabled.'
            );
        }
    }

    /**
     * @return void
     */
    public function checkPostAuth(SymfonyUserInterface $user)
    {
    }
}
