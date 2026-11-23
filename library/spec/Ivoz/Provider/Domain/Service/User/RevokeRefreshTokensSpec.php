<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\RefreshTokenRevokerInterface;
use Ivoz\Provider\Domain\Service\User\RevokeRefreshTokens;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class RevokeRefreshTokensSpec extends ObjectBehavior
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
        $this->shouldHaveType(RevokeRefreshTokens::class);
    }

    function it_should_be_post_persist_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            UserLifecycleEventHandlerInterface::class
        );

        $binding = RevokeRefreshTokens::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_POST_PERSIST => 200]) {
            throw new FailureException('Post persist binding expected');
        }
    }

    function it_does_nothing_on_new_users()
    {
        $user = $this->getUser(true, false, ['active', 'pass', 'email']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user->reveal());
    }

    function it_revokes_tokens_when_user_gets_disabled()
    {
        $user = $this->getUser(false, false, ['active']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user->reveal());
    }

    function it_does_nothing_when_user_gets_enabled()
    {
        $user = $this->getUser(false, true, ['active']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user->reveal());
    }

    function it_revokes_tokens_when_password_changes()
    {
        $user = $this->getUser(false, true, ['pass']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user->reveal());
    }

    function it_revokes_previous_email_tokens_when_email_changes()
    {
        $user = $this->getUser(false, true, ['email']);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername('alice@democompany.com')
            ->shouldBeCalledOnce();

        $this->execute($user->reveal());
    }

    function it_does_nothing_when_other_fields_change()
    {
        $user = $this->getUser(false, true, []);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user->reveal());
    }

    function it_does_nothing_when_user_had_no_email()
    {
        $user = $this->getUser(false, false, ['active', 'email'], null);

        $this
            ->refreshTokenRevoker
            ->revokeByUsername(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user->reveal());
    }

    /**
     * @param string[] $changedFields
     * @param string|null $initialEmail
     */
    private function getUser(
        bool $isNew,
        bool $active,
        array $changedFields,
        $initialEmail = 'alice@democompany.com'
    ) {
        $user = $this->getTestDouble(UserInterface::class);

        $this->getterProphecy(
            $user,
            [
                'isNew' => $isNew,
                'getActive' => $active,
                'getEmail' => 'new@democompany.com',
            ],
            false
        );

        foreach (['active', 'pass', 'email'] as $field) {
            $user
                ->hasChanged($field)
                ->willReturn(in_array($field, $changedFields, true));
        }

        $user
            ->getInitialValue('email')
            ->willReturn($initialEmail);

        return $user;
    }
}
