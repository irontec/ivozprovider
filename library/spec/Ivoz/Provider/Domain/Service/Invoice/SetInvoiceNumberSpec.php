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

class SetInvoiceNumberSpec extends ObjectBehavior
{
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

    public function it_sets_invoice_number(
        InvoiceInterface $invoice,
        InvoiceDto $invoiceDto,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $invoice
            ->hasChanged('status')
            ->willReturn(true);

        $invoice
            ->isProcessing()
            ->willReturn(true);

        $invoice
            ->getNumber()
            ->willReturn(null);

        $invoice
            ->getNumberSequence()
            ->willReturn($invoiceNumberSequence);

        $this
            ->nextValGenerator
            ->execute($invoiceNumberSequence)
            ->willReturn(3);

        $this
            ->entityTools
            ->entityToDto($invoice)
            ->willReturn($invoiceDto);

        $invoiceDto
            ->setNumber(3)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $invoiceDto,
                $invoice,
                false
            )->shouldBeCalled();

        $this->execute($invoice, false);
    }
}
