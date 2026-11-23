<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserEnabledChecker;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class UserEnabledCheckerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserEnabledChecker::class);
    }

    function it_ignores_non_user_accounts(
        SymfonyUserInterface $administrator
    ) {
        $this->checkPreAuth($administrator);
    }

    function it_accepts_enabled_users(
        UserInterface $user
    ) {
        $user->implement(SymfonyUserInterface::class);

        $user
            ->isEnabled()
            ->willReturn(true);

        $this->checkPreAuth($user);
    }

    function it_rejects_disabled_users(
        UserInterface $user
    ) {
        $user->implement(SymfonyUserInterface::class);

        $user
            ->isEnabled()
            ->willReturn(false);

        $this
            ->shouldThrow(
                new CustomUserMessageAccountStatusException('Your user account was disabled.')
            )
            ->during('checkPreAuth', [$user]);
    }

    function it_does_nothing_on_post_auth(
        UserInterface $user
    ) {
        $user->implement(SymfonyUserInterface::class);

        $user
            ->isEnabled()
            ->shouldNotBeCalled();

        $this->checkPostAuth($user);
    }
}
