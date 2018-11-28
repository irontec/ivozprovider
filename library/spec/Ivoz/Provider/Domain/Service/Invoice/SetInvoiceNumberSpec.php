<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Service\Invoice\SetInvoiceNumber;
use Ivoz\Provider\Domain\Service\InvoiceNumberSequence\NextValGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SetInvoiceNumberSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var NextValGenerator
     */
    protected $nextValGenerator;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        NextValGenerator $nextValGenerator,
        EntityTools $entityTools
    ) {
        $this->nextValGenerator = $nextValGenerator;
        $this->entityTools = $entityTools;

        $this->beConstructedWith($nextValGenerator, $entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SetInvoiceNumber::class);
    }

    protected function getInvoiceGetterProphecy(
        $length = null,
        InvoiceNumberSequenceInterface $invoiceNumberSequence = null
    ) {
        $response = [
            'hasChanged' => function () {
                return [['status'], true];
            },
            'isProcessing' => true,
            'getNumber' => null,
            'getNumberSequence' => $invoiceNumberSequence
        ];

        return array_slice(
            $response,
            0,
            $length
        );
    }

    public function it_sets_invoice_number(
        InvoiceInterface $invoice,
        InvoiceDto $invoiceDto,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->getterProphecy(
            $invoice,
            $this->getInvoiceGetterProphecy(null, $invoiceNumberSequence)
        );

        $this->getterProphecy(
            $this->entityTools,
            [
                'entityToDto' => function () use ($invoice, $invoiceDto) {
                    return [[$invoice], $invoiceDto];
                },
                'updateEntityByDto' => function () use ($invoice, $invoiceDto) {
                    return [[$invoice, $invoiceDto], null];
                }
            ]
        );

        $this
            ->nextValGenerator
            ->execute($invoiceNumberSequence)
            ->willReturn(3);

        $invoiceDto
            ->setNumber(3)
            ->shouldBeCalled();

        $this->execute($invoice);
    }

    public function it_does_nothing_if_status_is_not_changed(
        InvoiceInterface $invoice
    ) {
        $invoice
            ->hasChanged('status')
            ->willReturn(false)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->updateEntityByDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($invoice);
    }

    public function it_does_nothing_if_not_processing(
        InvoiceInterface $invoice
    ) {
        $getters = $this->getInvoiceGetterProphecy(1);
        $getters['isProcessing'] = false;

        $this->getterProphecy(
            $invoice,
            $getters
        );

        $this
            ->entityTools
            ->updateEntityByDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($invoice);
    }

    public function it_does_nothing_if_not_empty_number(
        InvoiceInterface $invoice
    ) {
        $getters = $this->getInvoiceGetterProphecy(2);
        $getters['getNumber'] = 'something';

        $this->getterProphecy(
            $invoice,
            $getters
        );

        $this
            ->entityTools
            ->updateEntityByDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($invoice);
    }


    public function it_does_nothing_if_wmpty_number_sequence(
        InvoiceInterface $invoice
    ) {
        $getters = $this->getInvoiceGetterProphecy(null, null);

        $this->getterProphecy(
            $invoice,
            $getters
        );

        $this
            ->entityTools
            ->updateEntityByDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($invoice);
    }
}
