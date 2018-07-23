<?php

namespace spec\Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\Invoice\CreateByScheduler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class CreateBySchedulerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var
     */
    private $logger;

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->beConstructedWith(
            $entityTools,
            $logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            CreateByScheduler::class
        );
    }

    function it_updates_last_execution(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        CompanyInterface $company,
        BrandInterface $brand,
        TimezoneInterface $timezone,
        InvoiceTemplateInterface $invoiceTemplate,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        //////////////////////////////////
        /// $timezone
        //////////////////////////////////
        $timezone
            ->getTz()
            ->willReturn('UTC')
            ->shouldBeCalled();

        //////////////////////////////////
        /// $brand
        //////////////////////////////////
        $brand
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $brand
            ->getDefaultTimezone()
            ->willReturn($timezone)
            ->shouldBeCalled();

        //////////////////////////////////
        /// $scheduler
        //////////////////////////////////
        $this->getterProphecy(
            $scheduler,
            [
                'getId' => 1,
                'getTaxRate' => 1,
                'getCompany' => $company,
                'getBrand' => $brand,
                'getInterval' => new \DateInterval('P1W'),
                'getNextExecution' => new \DateTime('2018-01-02 03:04:05'),
                'getInvoiceTemplate' => $invoiceTemplate,
                'getRelFixedCosts' => $fixedCostsRelInvoiceScheduler,
                'getNumberSequence' => $invoiceNumberSequence
            ]
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(InvoiceDto::class),
                null,
                true
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $schedulerDto
            ->setLastExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($schedulerDto, $scheduler, true)
            ->shouldBeCalled();

        $this->execute($scheduler);
    }

    function it_creates_invoices(
        InvoiceSchedulerInterface $scheduler,
        InvoiceSchedulerDto $schedulerDto,
        BrandInterface $brand,
        CompanyInterface $company,
        InvoiceTemplateInterface $invoiceTemplate,
        TimezoneInterface $timezone,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler,
        InvoiceNumberSequenceInterface $invoiceNumberSequence
    ) {
        //////////////////////////////////
        /// $timezone
        //////////////////////////////////
        $timezone
            ->getTz()
            ->willReturn('UTC')
            ->shouldBeCalled();

        //////////////////////////////////
        /// $brand
        //////////////////////////////////
        $brand
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $brand
            ->getDefaultTimezone()
            ->willReturn($timezone)
            ->shouldBeCalled();

        //////////////////////////////////
        /// $scheduler
        //////////////////////////////////
        $this->getterProphecy(
            $scheduler,
            [
                'getId' => 1,
                'getTaxRate' => 1,
                'getCompany' => $company,
                'getBrand' => $brand,
                'getInterval' => new \DateInterval('P1W'),
                'getNextExecution' => new \DateTime('2018-01-02 03:04:05'),
                'getInvoiceTemplate' => $invoiceTemplate,
                'getRelFixedCosts' => $fixedCostsRelInvoiceScheduler,
                'getNumberSequence' => $invoiceNumberSequence
            ]
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::that(function ($invoiceDto) {

                    /** @var InvoiceDto $invoiceDto */
                    if (!($invoiceDto instanceof InvoiceDto)) {
                        // InvoiceScheduler, we don't care
                        return true;
                    }

                    $outDate = $invoiceDto->getOutDate()->format('Y-m-d H:i:s');
                    if ($outDate !== '2018-01-01 23:59:59') {
                        return false;
                    }

                    $inDate = $invoiceDto->getInDate()->format('Y-m-d H:i:s');
                    if ($inDate !== '2017-12-26 00:00:00') {
                        return false;
                    }

                    return true;
                }),
                Argument::type('null'),
                true
            )
            ->shouldBeCalled();


        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $schedulerDto
            ->setLastExecution(
                Argument::type(\DateTime::class)
            );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(InvoiceSchedulerDto::class),
                Argument::type(InvoiceSchedulerInterface::class),
                true
            )
            ->shouldBeCalled();

        $this->execute($scheduler);
    }
}
