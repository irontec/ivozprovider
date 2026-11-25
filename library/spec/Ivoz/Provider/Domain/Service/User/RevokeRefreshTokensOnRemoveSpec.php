<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\RefreshTokenRevokerInterface;
use Ivoz\Provider\Domain\Service\User\RevokeRefreshTokensOnRemove;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class RevokeRefreshTokensOnRemoveSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $refreshTokenRevoker;

    public function let()
    {
        $this->refreshTokenRevoker = $this->getTestDouble(RefreshTokenRevokerInterface::class);

        $this->beConstructedWith(
            $this->refreshTokenRevoker
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RevokeRefreshTokensOnRemove::class);
    }

    function it_should_be_pre_remove_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            UserLifecycleEventHandlerInterface::class
        );

        $binding = RevokeRefreshTokensOnRemove::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_PRE_REMOVE => 200]) {
            throw new FailureException('Pre remove binding expected');
        }
    }

    function it_revokes_user_tokens()
    {
        $user = $this->getTestDouble(UserInterface::class);
        $this->getterProphecy($user, ['getEmail' => 'alice@democompany.com']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user->reveal());
    }

    function it_does_nothing_when_user_has_no_email()
    {
        $user = $this->getTestDouble(UserInterface::class);
        $this->getterProphecy($user, ['getEmail' => null]);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user->reveal());
    }
}
