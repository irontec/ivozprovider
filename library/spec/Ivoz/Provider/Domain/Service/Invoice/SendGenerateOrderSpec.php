<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Service\Invoice\InvoiceLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\Invoice\SendGenerateOrder;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use Ivoz\Provider\Infrastructure\Redis\Jobs\Invoicer;

class SendGenerateOrderSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $invoicer;

    public function let()
    {
        $this->invoicer = $this->getTestDouble(Invoicer::class);

        $this->beConstructedWith(
            $this->invoicer
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendGenerateOrder::class);
    }

    function it_should_be_on_commit_lifecycle_service()
    {
        $this->shouldBeAnInstanceOf(
            InvoiceLifecycleEventHandlerInterface::class
        );

        $binding = SendGenerateOrder::getSubscribedEvents();
        if ($binding != [LifecycleEventHandlerInterface::EVENT_ON_COMMIT => 10]) {
            throw new FailureException('On commit binding expected');
        }
    }

    function it_triggers_invoicer_order()
    {
        $invoice = $this->getTestDouble(InvoiceInterface::class);
        $this->prepareExecution($invoice);

        $this
            ->invoicer
            ->send()
            ->will(function () {
            })
            ->shouldBeCalled();

        $this->execute($invoice->reveal());
    }

    function it_requires_mustRunInvoicer_to_be_true()
    {
        $invoice = $this->getTestDouble(InvoiceInterface::class);

        $this->prepareExecution($invoice);
        $invoice
            ->mustRunInvoicer()
            ->willReturn(false);

        $this
            ->invoicer
            ->send(null)
            ->shouldNotBeCalled();

        $this->execute($invoice->reveal());
    }

    /**
     * @param $invoice
     */
    private function prepareExecution($invoice)
    {
        $this->getterProphecy(
            $invoice,
            [
                'getId' => 1,
                'mustRunInvoicer' => true
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->invoicer,
            [
                'setId' => 1,
            ],
            false
        );
    }
}
