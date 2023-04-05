<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use Ivoz\Provider\Domain\Service\FixedCostsRelInvoice\CreateByScheduler as FixedCostsRelInvoiceByScheduler;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\SetExecutionError;
use Ivoz\Provider\Domain\Service\InvoiceScheduler\UpdateLastExecutionDate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class CreateBySchedulerSpec extends ObjectBehavior
{
    use HelperTrait;

    private $entityTools;
    protected $logger;
    protected $fixedCostsRelInvoiceByScheduler;
    protected $updateLastExecutionDate;
    protected $setExecutionError;

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger,
        FixedCostsRelInvoiceByScheduler $fixedCostsRelInvoiceByScheduler,
        UpdateLastExecutionDate $updateLastExecutionDate,
        SetExecutionError $setExecutionError
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->fixedCostsRelInvoiceByScheduler = $fixedCostsRelInvoiceByScheduler;
        $this->updateLastExecutionDate = $updateLastExecutionDate;
        $this->setExecutionError = $setExecutionError;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->fixedCostsRelInvoiceByScheduler,
            $this->updateLastExecutionDate,
            $this->setExecutionError
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            CreateByScheduler::class
        );
    }

    function it_logs_errors(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $exception = new \Exception(
            'Some error'
        );

        $this
            ->setExecutionError
            ->execute(
                $scheduler,
                'Some error'
            )
            ->shouldBeCalled();

        $scheduler
            ->getName()
            ->willReturn('Name')
            ->shouldBeCalled();

        $scheduler
            ->getBrand()
            ->willThrow($exception)
            ->shouldBeCalled();

        $this
            ->logger
            ->error('Invoice scheduler #Name has failed: Some error')
            ->shouldBeCalled();

        $this
            ->shouldThrow($exception)
            ->during('execute', [$scheduler]);
    }

    function it_persists_errors(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $exception = new \Exception(
            'Some error'
        );

        $scheduler
            ->getBrand()
            ->willThrow($exception)
            ->shouldBeCalled();

        $this
            ->setExecutionError
            ->execute(
                $scheduler,
                'Some error'
            )
            ->shouldBeCalled();

        $this
            ->shouldThrow($exception)
            ->during('execute', [$scheduler]);
    }

    function it_updates_last_execution(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $this
            ->updateLastExecutionDate
            ->execute($scheduler)
            ->shouldbeCalled();

        $this->execute($scheduler);
    }

    public function it_updates_scheduler_last_execution_even_if_a_exception_is_thrown(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $this
            ->updateLastExecutionDate
            ->execute($scheduler)
            ->shouldbeCalled();

        $scheduler
            ->getNextExecution()
            ->willThrow(new \Exception('Some error'))
            ->shouldBeCalled();

        $this
            ->shouldThrow(\Exception::class)
            ->during('execute', [$scheduler]);
    }

    function it_creates_invoices(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        BrandInterface $brand,
        CompanyInterface $company,
        InvoiceTemplateInterface $invoiceTemplate,
        TimezoneInterface $timezone,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(InvoiceDto::class),
                null,
                true
            )
            ->willReturn($invoice)
            ->shouldBeCalled();

        $this->execute($scheduler);
    }

    function it_sets_fixed_costs(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        BrandInterface $brand,
        CompanyInterface $company,
        InvoiceTemplateInterface $invoiceTemplate,
        TimezoneInterface $timezone,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $invoice,
            $company,
            $brand,
            $timezone,
            $invoiceTemplate,
            $fixedCostsRelInvoiceScheduler,
            $fixedCost,
            $invoiceNumberSequence
        );

        $this
            ->fixedCostsRelInvoiceByScheduler
            ->execute(
                $scheduler,
                $invoice
            )->shouldBeCalled();

        $this->execute($scheduler);
    }

    /**
     * @param InvoiceSchedulerInterface $scheduler
     * @param CompanyInterface $company
     * @param BrandInterface $brand
     * @param TimezoneInterface $timezone
     * @param InvoiceTemplateInterface $invoiceTemplate
     * @param FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler
     * @param InvoiceNumberSequenceInterface $invoiceNumberSequence
     * @throws \Exception
     */
    protected function prepareExecution(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        InvoiceInterface $invoice,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        FixedCostInterface $fixedCost,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        //////////////////////////////////
        /// $timezone
        //////////////////////////////////
        $timezone
            ->getTz()
            ->willReturn('UTC');

        //////////////////////////////////
        /// $brand
        //////////////////////////////////
        $brand
            ->getId()
            ->willReturn(1);

        $brand
            ->getDefaultTimezone()
            ->willReturn($timezone);

        //////////////////////////////////
        /// $scheduler
        //////////////////////////////////
        $this->getterProphecy(
            $scheduler,
            [
                'getId' => 1,
                'getTaxRate' => 1,
                'getCompany' => $company,
                'getName' => 'name',
                'getBrand' => $brand,
                'getInterval' => new \DateInterval('P1W'),
                'getNextExecution' => new \DateTime('2018-01-02 03:04:05'),
                'getInvoiceTemplate' => $invoiceTemplate,
                'getRelFixedCosts' => [$fixedCostsRelInvoiceScheduler],
                'getNumberSequence' => $invoiceNumberSequence
            ],
            false
        );

        $fixedCostsRelInvoiceScheduler
            ->getQuantity()
            ->willReturn(1);

        $fixedCostsRelInvoiceScheduler
            ->getFixedCost()
            ->willReturn($fixedCost);

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $schedulerDto
            ->setLastExecution(
                Argument::type(\DateTime::class)
            )
            ->willReturn($schedulerDto);

        $schedulerDto
            ->setLastExecutionError('')
            ->willReturn($schedulerDto);

        $this
            ->entityTools
            ->persist(Argument::type(FixedCostsRelInvoice::class))
            ->willReturn(null);

        $this
            ->entityTools
            ->updateEntityByDto(
                Argument::type(InvoiceSchedulerInterface::class),
                Argument::type(InvoiceSchedulerDto::class)
            )
            ->willReturn($scheduler->getWrappedObject());

        $this
            ->entityTools
            ->persistDto(
                Argument::type(InvoiceDto::class),
                null,
                true
            )
            ->willReturn($invoice);

        $this
            ->entityTools
            ->persistDto(
                $schedulerDto,
                $scheduler,
                true
            )->willReturn($scheduler);
    }
}
