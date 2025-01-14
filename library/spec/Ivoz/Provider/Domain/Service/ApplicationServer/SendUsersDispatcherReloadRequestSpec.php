<?php

namespace spec\Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherInterface;
use Ivoz\Kam\Domain\Model\Dispatcher\DispatcherRepository;
use Ivoz\Kam\Domain\Service\UsersClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\ApplicationServerLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServer\SendUsersDispatcherReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophecy\MethodProphecy;
use spec\HelperTrait;

class SendUsersDispatcherReloadRequestSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $usersClient;
    protected $dispatcherRepository;

    public function let(
        DispatcherRepository $dispatcherRepository,
    ) {
        $this->dispatcherRepository = $this->getTestDouble(DispatcherRepository::class);
        $this->usersClient = $this->getTestDouble(UsersClientInterface::class);

        $this->beConstructedWith(
            $this->usersClient,
            $this->dispatcherRepository,
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendUsersDispatcherReloadRequest::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            ApplicationServerLifecycleEventHandlerInterface::class
        );

        $binding = SendUsersDispatcherReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_dispatcher_reload_request_on_updated_ip()
    {
        $applicationServer = $this->getTestDouble(ApplicationServerInterface::class);

        $this->getterProphecy(
            $applicationServer,
            [
                'getId' => 1,
                'hasBeenDeleted' => false,
                'isNew' => false,
            ],
            true
        )->hasChanged('ip')
            ->shouldBeCalled()
            ->willReturn(true);

        $this->prepareExecution();

        $this
            ->dispatcherRepository
            ->findByApplicationServerId(1)
            ->shouldBeCalled()
            ->willReturn([
                $this->getTestDouble(DispatcherInterface::class),
            ]);

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldBeCalled();



        $this->execute($applicationServer->reveal());
    }

    function it_requires_application_server_to_be_not_new()
    {
        $applicationServer = $this->getTestDouble(ApplicationServer::class);

        $this->getterProphecy(
            $applicationServer,
            [
                'getId' => 1,
                'hasBeenDeleted' => false,
                'isNew' => true,
                'hasChanged' => false,
            ],
            false
        );

        $this->prepareExecution();

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($applicationServer->reveal());
    }

    function it_requiere_application_server_to_be_not_deleted()
    {
        $applicationServer = $this->getTestDouble(ApplicationServer::class);

        $this->getterProphecy(
            $applicationServer,
            [
                'getId' => 1,
                'hasBeenDeleted' => true,
                'isNew' => false,
                'hasChanged' => true,
            ],
            false
        );

        $this->prepareExecution();

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($applicationServer->reveal());
    }

    function it_requiere_application_server_ip_to_be_updated()
    {
        $applicationServer = $this->getTestDouble(ApplicationServer::class);

        $this->getterProphecy(
            $applicationServer,
            [
                'getId' => 1,
                'hasBeenDeleted' => false,
                'isNew' => false,
                'hasChanged' => true,
            ],
            false
        )->hasChanged('ip')
            ->shouldBeCalled()
            ->willReturn(false);


        $this->prepareExecution();

        $this
            ->usersClient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($applicationServer->reveal());
    }

    private function prepareExecution()
    {
        $this->fluentSetterProphecy(
            $this->dispatcherRepository,
            [],
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
