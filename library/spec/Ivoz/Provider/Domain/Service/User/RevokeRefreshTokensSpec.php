<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\RefreshTokenRevokerInterface;
use Ivoz\Provider\Domain\Service\User\RevokeRefreshTokens;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RevokeRefreshTokensSpec extends ObjectBehavior
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
        $this->shouldHaveType(RevokeRefreshTokens::class);
    }

    function it_does_nothing_on_new_users(
        UserInterface $user
    ) {
        $this->prepareUser($user, true, false, ['active', 'pass', 'email']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }

    function it_revokes_tokens_when_user_gets_disabled(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, false, ['active']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user);
    }

    function it_does_nothing_when_user_gets_enabled(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, true, ['active']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }

    function it_revokes_tokens_when_password_changes(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, true, ['pass']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user);
    }

    function it_revokes_previous_email_tokens_when_email_changes(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, true, ['email']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user);
    }

    function it_does_nothing_when_other_fields_change(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, true, []);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }

    function it_does_nothing_when_user_had_no_email(
        UserInterface $user
    ) {
        $this->prepareUser($user, false, false, ['active', 'email'], null);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }

    /**
     * @param string[] $changedFields
     * @param string|null $initialEmail
     */
    private function prepareUser(
        UserInterface $user,
        bool $isNew,
        bool $active,
        array $changedFields,
        $initialEmail = 'alice@democompany.com'
    ): void {
        $user
            ->isNew()
            ->willReturn($isNew);

        $user
            ->getActive()
            ->willReturn($active);

        foreach (['active', 'pass', 'email'] as $field) {
            $user
                ->hasChanged($field)
                ->willReturn(in_array($field, $changedFields, true));
        }

        $user
            ->getEmail()
            ->willReturn('new@democompany.com');

        $user
            ->getInitialValue('email')
            ->willReturn($initialEmail);
    }
}
