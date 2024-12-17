<?php

namespace spec\Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSet\ApplicationServerSetLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\ApplicationServerSet\SendTrunksDispatcherReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class SendTrunksDispatcherReloadRequestSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $trunksCient;

    public function let()
    {
        $this->trunksCient = $this->getTestDouble(TrunksClientInterface::class);

        $this->beConstructedWith(
            $this->trunksCient
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendTrunksDispatcherReloadRequest::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            ApplicationServerSetLifecycleEventHandlerInterface::class
        );

        $binding = SendTrunksDispatcherReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_dispatcher_reload_request()
    {
        $ApplicationServerSet = $this
            ->getTestDouble(
                ApplicationServerSetInterface::class
            );

        $this->prepareExecution($ApplicationServerSet);

        $ApplicationServerSet
            ->hasBeenDeleted()
            ->shouldBeCalled()
            ->willReturn(true);

        $this
            ->trunksCient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($ApplicationServerSet->reveal());
    }

    function it_requires_hasBeenDeleted_to_be_true()
    {
        $ApplicationServerSet = $this->getTestDouble(ApplicationServerSetInterface::class);
        $this->prepareExecution($ApplicationServerSet);

        $ApplicationServerSet
            ->hasBeenDeleted()
            ->shouldBeCalled()
            ->willReturn(false);

        $this
            ->trunksCient
            ->reloadDispatcher()
            ->will(function () {
            })
            ->shouldNotBeCalled();

        $this->execute($ApplicationServerSet->reveal());
    }

    private function prepareExecution($ApplicationServerSet)
    {
        $this->fluentSetterProphecy(
            $ApplicationServerSet,
            [
                'getId' => 1,
                'hasBeenDeleted' => true
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->trunksCient,
            [
            ],
            false
        );
    }
}
