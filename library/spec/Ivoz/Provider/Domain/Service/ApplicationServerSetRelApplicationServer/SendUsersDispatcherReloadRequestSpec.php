<?php

namespace spec\Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer\SendUsersDispatcherReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class SendUsersDispatcherReloadRequestSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $usersClient;

    public function let()
    {
        $this->usersClient = $this->getTestDouble(
            UsersClientInterface::class
        );

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
            ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface::class
        );

        $binding = SendUsersDispatcherReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_dispatcher_reload_request_on_deletion()
    {
        $asSetRelApplicationServer = $this->getTestDouble(
            ApplicationServerSetRelApplicationServer::class,
        );

        $this->getterProphecy(
            $asSetRelApplicationServer,
            [
                'hasBeenDeleted' => true,
                'isNew' => false,
            ],
            false,
        );

        $this->prepareExecution();

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($asSetRelApplicationServer->reveal());
    }

    function it_sends_dispatcher_reload_request_on_insert()
    {
        $asSetRelApplicationServer = $this->getTestDouble(
            ApplicationServerSetRelApplicationServer::class,
        );

        $this->prepareExecution();

        $this->getterProphecy(
            $asSetRelApplicationServer,
            [
                'hasBeenDeleted' => false,
                'isNew' => true,
            ],
            false,
        );

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($asSetRelApplicationServer->reveal());
    }

    function it_requires_to_be_new_or_deleted()
    {
        $asSetRelApplicationServer = $this->getTestDouble(
            ApplicationServerSetRelApplicationServer::class,
        );

        $this->prepareExecution();

        $this->getterProphecy(
            $asSetRelApplicationServer,
            [
                'hasBeenDeleted' => false,
                'isNew' => false,
            ],
            true,
        );

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($asSetRelApplicationServer->reveal());
    }

    private function prepareExecution()
    {
        $this->fluentSetterProphecy(
            $this->usersClient,
            [
            ],
            false
        );
    }
}
