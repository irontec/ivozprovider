<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\RefreshTokenRevokerInterface;
use Ivoz\Provider\Domain\Service\User\RevokeRefreshTokensOnRemove;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RevokeRefreshTokensOnRemoveSpec extends ObjectBehavior
{
    protected $refreshTokenRevoker;

    public function let(
        RefreshTokenRevokerInterface $refreshTokenRevoker
    ) {
        $this->refreshTokenRevoker = $refreshTokenRevoker;

        $this->beConstructedWith(
            $refreshTokenRevoker
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RevokeRefreshTokensOnRemove::class);
    }

    function it_revokes_user_tokens(
        UserInterface $user
    ) {
        $user
            ->getEmail()
            ->willReturn('alice@democompany.com');

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user);
    }

    function it_does_nothing_when_user_has_no_email(
        UserInterface $user
    ) {
        $user
            ->getEmail()
            ->willReturn(null);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }
}
