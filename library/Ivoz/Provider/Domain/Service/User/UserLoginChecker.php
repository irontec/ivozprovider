<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\HostnameGetter;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

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

        $hostName = $this->hostnameGetter->__invoke() ?? '';
        $this->assertWebPortalAccesible->execute(
            $admin,
            $hostName
        );
    }

    /**
     * @return void
     */
    public function checkPostAuth(SymfonyUserInterface $user)
    {
    }
}
