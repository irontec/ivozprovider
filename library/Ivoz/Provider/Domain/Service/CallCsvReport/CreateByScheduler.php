<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Psr\Log\LoggerInterface;

class CreateByScheduler
{
    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @throws \Exception
     */
    public function execute(CallCsvSchedulerInterface $scheduler)
    {
        $report = null;

        try {
            $this->updateLastExecutionDate($scheduler);
            $this->createCallCsvReport($scheduler);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $name = $scheduler->getName();
            $this->logger->error(
                "Call CSV scheduler #${name} has failed: " . $error
            );

            $this->setExecutionError($scheduler, $error);
            throw $e;
        }
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @return CallCsvReportInterface
     */
    private function createCallCsvReport(CallCsvSchedulerInterface $scheduler)
    {
        $outDate = clone $scheduler->getNextExecution();
        $outDate->setTimezone(
            new \DateTimeZone(
                $scheduler->getTimezone()->getTz()
            )
        );
        $outDate->setTime(0, 0, 0);
        $outDate->modify('1 second ago');

        $inDate = clone $outDate;
            $inDate->sub(
                $scheduler->getInterval()
            )->modify('+1 second');

        // Back to UTC
        $utc = new \DateTimeZone('UTC');
        $outDate->setTimezone($utc);
        $inDate->setTimezone($utc);

        $company = $scheduler->getCompany();
        $reportDto = new CallCsvReportDto();
        $reportDto
            ->setInDate($inDate)
            ->setOutDate($outDate)
            ->setCreatedOn(new \DateTime(null, $utc))
            ->setCompanyId(
                $company->getId()
            )
            ->setCallCsvSchedulerId(
                $scheduler->getId()
            )->setSentTo(
                $scheduler->getEmail()
            );

        /** @var CallCsvReportInterface $report */
        $report = $this->entityTools->persistDto(
            $reportDto,
            null,
            true
        );

        return $report;
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @return void
     */
    private function updateLastExecutionDate(CallCsvSchedulerInterface $scheduler)
    {
        /** @var CallCsvSchedulerDto $callCsvSchedulerDto */
        $callCsvSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $callCsvSchedulerDto
            ->setLastExecution(
                new \DateTime()
            )->setLastExecutionError('');

        $this->entityTools->persistDto(
            $callCsvSchedulerDto,
            $scheduler,
            true
        );
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @param $error
     */
    private function setExecutionError(CallCsvSchedulerInterface $scheduler, string $error)
    {
        /** @var CallCsvSchedulerDto $callCsvSchedulerDto */
        $callCsvSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $callCsvSchedulerDto
            ->setLastExecutionError($error);

        $this->entityTools->persistDto(
            $callCsvSchedulerDto,
            $scheduler,
            true
        );
    }
}
