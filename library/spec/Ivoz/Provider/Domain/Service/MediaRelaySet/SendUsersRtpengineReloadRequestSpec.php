<?php

namespace spec\Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Service\MediaRelaySet\MediaRelaySetEventHandlerInterface;
use Ivoz\Provider\Domain\Service\MediaRelaySet\SendUsersRtpengineReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class SendUsersRtpengineReloadRequestSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $usersClient;

    public function let()
    {
        $this->usersClient = $this->getTestDouble(UsersClientInterface::class);

        $this->beConstructedWith(
            $this->usersClient
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendUsersRtpengineReloadRequest::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            MediaRelaySetEventHandlerInterface::class
        );

        $binding = SendUsersRtpengineReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_rtpengine_reload_request()
    {
        $mediaRelaySet = $this->getTestDouble(MediaRelaySetInterface::class);
        $this->prepareExecution($mediaRelaySet);

        $this
            ->usersClient
            ->reloadRtpengine()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($mediaRelaySet->reveal());
    }

    function it_requires_hasBeenDeleted_to_be_true()
    {
        $mediaRelaySet = $this->getTestDouble(MediaRelaySetInterface::class);
        $this->prepareExecution($mediaRelaySet);

        $this
            ->usersClient
            ->reloadRtpengine()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($mediaRelaySet->reveal());
    }

    private function prepareExecution($mediaRelaySet)
    {
        $this->getterProphecy(
            $mediaRelaySet,
            [
                'getId' => 1,
                'hasBeenDeleted' => true
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->usersClient,
            [
            ],
            false
        );
    }
}
