<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Service\HostnameGetter;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class AdminLoginChecker implements UserCheckerInterface
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
        if (!$admin instanceof AdministratorInterface) {
            return;
        }

        if ($admin->getInternal()) {
            throw new CustomUserMessageAccountStatusException(
                'Unable to login as an internal admin'
            );
        }

        if (!$admin->isEnabled()) {
            throw new CustomUserMessageAccountStatusException(
                'Your admin account is disabled.'
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
