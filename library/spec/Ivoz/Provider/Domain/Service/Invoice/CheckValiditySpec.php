<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceRepository;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\Invoice\CheckValidity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CheckValiditySpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var BillableCallRepository
     */
    protected $billableCallRepository;

    /**
     * @var InvoiceRepository
     */
    protected $invoiveRepository;

    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    public function let(
        BillableCallRepository $billableCallRepository,
        InvoiceRepository $invoiceRepository,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone
    ) {
        $this->billableCallRepository = $billableCallRepository;
        $this->invoiveRepository = $invoiceRepository;

        $this->beConstructedWith(
            $billableCallRepository,
            $invoiceRepository
        );

        $this->invoice = $invoice;
        $this->company = $company;
        $this->brand = $brand;
        $this->timezone = $timezone;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
    }

    function it_throws_exception_on_future_dates()
    {
        $this->prepareExecution();

        $this->invoice
            ->getInDate()
            ->willReturn(new \DateTime('2 months ago'));

        $this->invoice
            ->getOutDate()
            ->willReturn(new \DateTime('next month'));

        $this
            ->shouldThrow(
                new \DomainException(
                    'Forbidden future dates',
                    CheckValidity::FORBIDDEN_FUTURE_DATES
                )
            )
            ->during('execute', [$this->invoice]);
    }

    function it_throws_exception_on_senseless_dates()
    {
        $this->prepareExecution();

        $this->invoice
            ->getInDate()
            ->willReturn(new \DateTime('2 months ago'));

        $this->invoice
            ->getOutDate()
            ->willReturn(new \DateTime('4 months ago'));

        $this
            ->shouldThrow(
                new \DomainException(
                    'In-Out date error',
                    CheckValidity::SENSELESS_IN_OUT_DATE
                )
            )
            ->during('execute', [$this->invoice]);
    }

    function it_throws_exception_on_unmetered_calls()
    {
        $this->prepareExecution();

        $this
            ->billableCallRepository
            ->countUntarificattedCallsBeforeDate(
                Argument::type('numeric'),
                Argument::type('numeric'),
                Argument::type('string')
            )->willReturn(1);

        $this
            ->shouldThrow(
                new \DomainException(
                    'Unmetered calls',
                    CheckValidity::UNMETERED_CALLS
                )
            )
            ->during('execute', [$this->invoice]);
    }

    function it_throws_exception_on_unbilled_calls_after_out_date(
        InvoiceInterface $invoice
    ) {
        $this->prepareExecution();

        $this
            ->invoiveRepository
            ->getInvoices(
                Argument::type('numeric'),
                Argument::type('numeric'),
                Argument::type('string'),
                Argument::type('numeric')
            )->willReturn([$invoice]);

        $invoice
            ->getInDate()
            ->willReturn(new \DateTime('1 year ago'));

        $this->billableCallRepository->countUntarificattedCallsInRange(
            Argument::type('numeric'),
            Argument::type('numeric'),
            Argument::type('string'),
            Argument::type('string')
        )->willReturn(1);

        $this
            ->shouldThrow(
                new \DomainException(
                    'Unbilled calls after out date',
                    CheckValidity::UNBILLED_CALLS_AFTER_OUT_DATE
                )
            )
            ->during('execute', [$this->invoice]);
    }

    function it_throws_exception_on_invoice_in_date_range()
    {
        $this->prepareExecution();

        $this->invoiveRepository
            ->fetchInvoiceNumberInRange(
                Argument::type('numeric'),
                Argument::type('numeric'),
                Argument::type('string'),
                Argument::type('string'),
                Argument::type('numeric')
            )->willReturn(1);

        $this
            ->shouldThrow(
                new \DomainException(
                    'Invoices found in the same range of date',
                    CheckValidity::INVOICES_FOUND_IN_THE_SAME_RANGE_OF_DATE
                )
            )
            ->during('execute', [$this->invoice]);
    }

    protected function prepareExecution()
    {
        $this->invoice
            ->getCompany()
            ->willReturn($this->company);

        $this->company
            ->getId()
            ->willReturn(2);

        $this->company
            ->getDefaultTimezone()
            ->willReturn($this->timezone);

        $this->invoice
            ->getBrand()
            ->willReturn($this->brand);

        $this->brand
            ->getId()
            ->willReturn(1);

        $this->invoice
            ->getInDate()
            ->willReturn(new \DateTime('2 months ago'));

        $this->invoice
            ->getId()
            ->willReturn(5);

        $this->invoice
            ->getOutDate()
            ->willReturn(new \DateTime('1 month ago'));

        $this->timezone
            ->getTz()
            ->willReturn("Europe/Madrid");

        $this
            ->billableCallRepository
            ->countUntarificattedCallsBeforeDate(
                Argument::type('numeric'),
                Argument::type('numeric'),
                Argument::type('string')
            )->willReturn(0);

        $this
            ->invoiveRepository
            ->getInvoices(
                Argument::type('numeric'),
                Argument::type('numeric'),
                Argument::type('string'),
                Argument::type('numeric')
            )->willReturn([]);
    }
}
