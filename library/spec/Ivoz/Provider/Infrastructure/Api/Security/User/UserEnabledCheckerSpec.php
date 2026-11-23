<?php

namespace spec\Ivoz\Provider\Infrastructure\Api\Security\User;

use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Infrastructure\Api\Security\User\UserEnabledChecker;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class UserEnabledCheckerSpec extends ObjectBehavior
{
    use HelperTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(UserEnabledChecker::class);
    }

    function it_ignores_non_user_accounts()
    {
        $administrator = $this->getTestDouble(SymfonyUserInterface::class);

        $this->checkPreAuth($administrator->reveal());
    }

    function it_accepts_enabled_users()
    {
        $user = $this->getTestDouble(User::class);
        $this->getterProphecy($user, ['isEnabled' => true]);

        $this->checkPreAuth($user->reveal());
    }

    function it_rejects_disabled_users()
    {
        $user = $this->getTestDouble(User::class);
        $this->getterProphecy($user, ['isEnabled' => false]);

        $this
            ->shouldThrow(
                new CustomUserMessageAccountStatusException('Your user account was disabled.')
            )
            ->during('checkPreAuth', [$user->reveal()]);
    }

    function it_does_nothing_on_post_auth()
    {
        $user = $this->getTestDouble(User::class);
        $user
            ->isEnabled()
            ->shouldNotBeCalled();

        $this->checkPostAuth($user->reveal());
    }
}
