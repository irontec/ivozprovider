<?php

namespace spec\Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksClientInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Service\MediaRelaySet\MediaRelaySetLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\MediaRelaySet\SendTrunksRtpengineReloadRequest;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class SendTrunksRtpengineReloadRequestSpec extends ObjectBehavior
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
        $this->shouldHaveType(SendTrunksRtpengineReloadRequest::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            MediaRelaySetLifecycleEventHandlerInterface::class
        );

        $binding = SendTrunksRtpengineReloadRequest::getSubscribedEvents();

        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 300]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_sends_rtpengine_reload_request()
    {
        $mediaRelaySet = $this->getTestDouble(MediaRelaySetInterface::class);
        $this->prepareExecution($mediaRelaySet);

        $this
            ->trunksCient
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
            ->trunksCient
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
            $this->trunksCient,
            [
            ],
            false
        );
    }
}
