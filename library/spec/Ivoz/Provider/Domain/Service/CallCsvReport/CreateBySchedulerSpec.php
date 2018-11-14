<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
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
     * @var LoggerInterface
     */
    protected $logger;

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            CreateByScheduler::class
        );
    }

    public function it_creates_reports_from_scheduler(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone,
        CompanyInterface $company,
        CallCsvReportInterface $callCsvReport
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $timezone,
            $company,
            $callCsvReport
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CallCsvSchedulerDto::class),
                Argument::type(CallCsvSchedulerInterface::class),
                true
            )
            ->shouldBeCalled();

        $this->execute($scheduler);
    }


    public function it_updates_scheduler_last_execution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone,
        CompanyInterface $company,
        CallCsvReportInterface $callCsvReport
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $timezone,
            $company,
            $callCsvReport
        );

        $schedulerDto
            ->setLastExecution(
                Argument::type(\DateTime::class)
            )
            ->shouldBeCalled();

        $this->execute($scheduler);
    }


    public function it_logs_exceptions(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone,
        CompanyInterface $company,
        CallCsvReportInterface $callCsvReport
    ) {
        $this->prepareExecution(
            $scheduler,
            $schedulerDto,
            $timezone,
            $company,
            $callCsvReport
        );

        $this
            ->logger
            ->error(Argument::any())
            ->shouldBeCalled();

        $scheduler
            ->getNextExecution()
            ->willThrow(new \Exception('Some error'))
            ->shouldBeCalled();

        $this
            ->shouldThrow(\Exception::class)
            ->during('execute', [$scheduler]);
    }

    protected function prepareExecution(
        CallCsvSchedulerInterface $scheduler,
        CallCsvSchedulerDto $schedulerDto,
        TimezoneInterface $timezone,
        CompanyInterface $company,
        CallCsvReportInterface $callCsvReport
    ) {
        $this->getterProphecy(
            $scheduler,
            [
                'getNextExecution' => new \DateTime('2015-01-01 01:01:01'),
                'getTimezone' => $timezone,
                'getCompany' => $company,
                'getName' => 'Name',
                'getId' => 1,
                'getEmail' => 'mikel@nowhere.com',
                'getInterval' =>  new \DateInterval('P1W')
            ],
            false
        );

        $timezone
            ->getTz()
            ->willReturn('UTC');

        $company
            ->getId()
            ->willReturn(1);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CallCsvReportDto::class),
                null,
                true
            )
            ->willReturn($callCsvReport);

        $this
            ->entityTools
            ->entityToDto($scheduler)
            ->willReturn($schedulerDto);

        $this
            ->entityTools
            ->persistDto(
                Argument::type(CallCsvSchedulerDto::class),
                Argument::type(CallCsvSchedulerInterface::class),
                true
            )
            ->willReturn(null);

        $this
            ->entityTools
            ->entityToDto($scheduler);
    }
}
