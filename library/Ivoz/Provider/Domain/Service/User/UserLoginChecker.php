<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\HostnameGetter;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class UserLoginChecker implements UserCheckerInterface
{
    public function __construct(
        private HostnameGetter $hostnameGetter,
        private AssertWebPortalAccessible $assertWebPortalAccesible
    ) {
    }

    /**
     * @return void
     */
    public function checkPreAuth(SymfonyUserInterface $admin)
    {
        if (!$admin instanceof UserInterface) {
            return;
        }

        /** @var UserInterface $admin */
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
