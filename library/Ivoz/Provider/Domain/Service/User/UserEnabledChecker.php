<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class UserEnabledChecker implements UserCheckerInterface
{
    /**
     * @return void
     */
    public function checkPreAuth(SymfonyUserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            return;
        }

        if ($user->isEnabled()) {
            return;
        }

        throw new CustomUserMessageAccountStatusException(
            'Your user account was disabled.'
        );
    }

    /**
     * @return void
     */
    public function checkPostAuth(SymfonyUserInterface $user)
    {
    }
}
