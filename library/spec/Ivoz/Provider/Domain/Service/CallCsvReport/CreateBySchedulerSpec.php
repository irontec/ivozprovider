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
use Ivoz\Provider\Domain\Service\CallCsvScheduler\UpdateLastExecutionDate;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\SetExecutionError;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class CreateBySchedulerSpec extends ObjectBehavior
{
    use HelperTrait;

    private $entityTools;
    protected $logger;
    protected $updateLastExecutionDate;
    protected $setExecutionError;

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger,
        UpdateLastExecutionDate $updateLastExecutionDate,
        SetExecutionError $setExecutionError
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->updateLastExecutionDate = $updateLastExecutionDate;
        $this->setExecutionError = $setExecutionError;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
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
                Argument::type(CallCsvReportDto::class),
                null,
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

        $this->updateLastExecutionDate
            ->execute(
                $scheduler
            )->shouldbeCalled();

        $this->execute($scheduler);
    }

    public function it_updates_scheduler_last_execution_even_if_a_exception_is_thrown(
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

        $this->updateLastExecutionDate
            ->execute(
                $scheduler
            )->shouldbeCalled();

        $scheduler
            ->getNextExecution()
            ->willThrow(new \Exception('Some error'))
            ->shouldBeCalled();

        $this
            ->shouldThrow(\Exception::class)
            ->during('execute', [$scheduler]);
    }

    public function it_accepts_no_company(
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

        $scheduler
            ->getCompany()
            ->willReturn(null)
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

    public function it_persists_errors(
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

        $errorMsg = 'Some error';

        $scheduler
            ->getNextExecution()
            ->willThrow(new \Exception($errorMsg))
            ->shouldBeCalled();

        $this->setExecutionError->execute(
            $scheduler,
            $errorMsg
        );

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
                'getBrand' => null,
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
    }
}
