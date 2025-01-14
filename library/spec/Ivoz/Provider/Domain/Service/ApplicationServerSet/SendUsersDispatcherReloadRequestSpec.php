<?php

namespace spec\Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSet\ApplicationServerSetLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSet\SendUsersDispatcherReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class SendUsersDispatcherReloadRequestSpec extends ObjectBehavior
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
        $this->shouldHaveType(SendUsersDispatcherReloadRequest::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            ApplicationServerSetLifecycleEventHandlerInterface::class
        );

        $binding = SendUsersDispatcherReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_dispatcher_reload_request()
    {
        $relApplicationServer = $this->getTestDouble(ApplicationServerSetInterface::class);
        $this->prepareExecution($relApplicationServer);

        $relApplicationServer
            ->hasBeenDeleted()
            ->shouldBeCalled()
            ->willReturn(true);

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($relApplicationServer->reveal());
    }

    function it_requires_hasBeenDeleted_to_be_true()
    {
        $relApplicationServer = $this->getTestDouble(ApplicationServerSetInterface::class);
        $this->prepareExecution($relApplicationServer);

        $relApplicationServer
            ->hasBeenDeleted()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($relApplicationServer->reveal());
    }

    private function prepareExecution($mediaRelaySet)
    {
        $this->fluentSetterProphecy(
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
