<?php

namespace spec\Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Infrastructure\Service\Asterisk\ARI\ARIConnector;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Service\FaxesInOut\SendFaxFile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SendFaxFileSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $ariConnector;

    function let(
        ARIConnector $ariConnector
    ) {
        $this->ariConnector = $ariConnector;

        $this->beConstructedWith($ariConnector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendFaxFile::class);
    }

    function it_does_nothing_when_type_is_not_out(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions(
            $entity, null
        );

        $this
            ->ariConnector
            ->sendFaxfileRequest(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_does_nothing_when_status_is_not_pending(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions(
            $entity, 'out', null
        );

        $this
            ->ariConnector
            ->sendFaxfileRequest(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_does_nothing_when_status_is_not_changed(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions(
            $entity, 'out', 'pending, false'
        );

        $this
            ->ariConnector
            ->sendFaxfileRequest(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_sends_fax_filerequest_(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions($entity);

        $this
            ->ariConnector
            ->sendFaxfileRequest($entity)
            ->shouldBeCalled();

        $this->execute($entity);
    }


    function it_sets_error_status_on_exception_(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions($entity);
        $exception = new \Exception();

        $this
            ->ariConnector
            ->sendFaxfileRequest(Argument::any())
            ->willThrow(new \Exception())
            ->shouldBeCalled();

        $entity
            ->setStatus('error')
            ->shouldBeCalled();

        $this
            ->shouldThrow($exception)
            ->during('execute', [$entity]);
    }

    protected function prepareSendFaxFileConditions(
        $entity, $type = 'Out', $status = 'pending', bool $statusChanged = true
    ) {
        $entity
            ->getType()
            ->willReturn($type)
            ->shouldBeCalled();

        $entity
            ->getStatus()
            ->willReturn($status)
            ->shouldBeCalled();

        $entity
            ->hasChanged('status')
            ->willReturn($statusChanged)
            ->shouldBeCalled();
    }
}
