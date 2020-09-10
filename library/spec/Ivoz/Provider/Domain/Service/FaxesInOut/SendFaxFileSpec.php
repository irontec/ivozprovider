<?php

namespace spec\Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Ast\Infrastructure\Asterisk\ARI\ARIConnector;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Ivoz\Provider\Domain\Service\FaxesInOut\SendFaxFile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SendFaxFileSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ARIConnector
     */
    protected $ariConnector;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    function let(
        ARIConnector $ariConnector,
        EntityTools $entityTools
    ) {
        $this->ariConnector = $ariConnector;
        $this->entityTools = $entityTools;

        $this->beConstructedWith($ariConnector, $entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendFaxFile::class);
    }

    function it_does_nothing_when_type_is_not_out(
        FaxesInOutInterface $entity
    ) {
        $this->prepareSendFaxFileConditions(
            $entity,
            null
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
            $entity,
            'out',
            null
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
            $entity,
            'out',
            'pending, false'
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
        FaxesInOutInterface $faxesInOut,
        FaxesInOutDto $faxesInOutDto
    ) {
        $this->prepareSendFaxFileConditions($faxesInOut);
        $exception = new \Exception();

        $this
            ->ariConnector
            ->sendFaxfileRequest(Argument::any())
            ->willThrow(new \Exception())
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($faxesInOut)
            ->willReturn($faxesInOutDto);

        $faxesInOutDto
            ->setStatus('error')
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($faxesInOutDto, $faxesInOut, true)
            ->shouldBeCalled();

        $this
            ->shouldThrow($exception)
            ->during('execute', [$faxesInOut]);
    }

    protected function prepareSendFaxFileConditions(
        $entity,
        $type = 'Out',
        $status = 'pending',
        bool $statusChanged = true
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
