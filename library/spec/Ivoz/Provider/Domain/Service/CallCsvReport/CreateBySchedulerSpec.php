<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Service\CallCsvReport\CreateByScheduler;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\SetExecutionError;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\UpdateLastExecutionDate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
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
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
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
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
        );

        $this
            ->updateLastExecutionDate
            ->execute(
                $scheduler
            )->shouldbeCalled();

        $this->execute($scheduler);
    }

    public function it_updates_scheduler_last_execution_even_if_a_exception_is_thrown(
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
        );

        $this
            ->updateLastExecutionDate
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
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
        );

        $scheduler
            ->getCompany()
            ->willReturn(null)
            ->shouldBeCalled();

        $this->execute($scheduler);
    }

    public function it_logs_exceptions(
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
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
        CallCsvSchedulerInterface $scheduler
    ) {
        $this->prepareExecution(
            $scheduler
        );

        $errorMsg = 'Some error';

        $scheduler
            ->getNextExecution()
            ->willThrow(new \Exception($errorMsg))
            ->shouldBeCalled();

        $this
            ->setExecutionError
            ->execute(
                $scheduler,
                $errorMsg
            );

        $this
            ->shouldThrow(\Exception::class)
            ->during('execute', [$scheduler]);
    }

    protected function prepareExecution(
        CallCsvSchedulerInterface $scheduler
    ) {
        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'UTC'
            ]
        );

        $company = $this->getInstance(
            Company::class,
            [
                'id' => 1
            ]
        );

        $callCsvReport = $this->getInstance(
            CallCsvReport::class
        );

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
