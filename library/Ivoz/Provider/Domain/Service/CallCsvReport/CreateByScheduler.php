<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Core\Infrastructure\Service\Rest\Client as RestClient;
use Psr\Log\LoggerInterface;

class CreateByScheduler
{
    /**
     * @var EntityTools
     */
    private $entityTools;

    /**
     * @var RestClient
     */
    protected $restClient;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        EntityTools $entityTools,
        RestClient $restClient,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->restClient = $restClient;
        $this->logger = $logger;
    }

    /**
     * @throws \DomainException
     */
    public function execute(CallCsvSchedulerInterface $scheduler)
    {

        $report = null;

        try {
            $report = $this->createCallCsvReport($scheduler);
            $this->updateLastExecutionDate($scheduler);
        } catch (\Exception $e) {

            $name = $scheduler->getName();
            $this->logger->error(
                "Call CSV scheduler #${$name} has failed: "
                . $e->getMessage()
            );

            if ($report && $report->getId()) {
                $this->updateLastExecutionDate($scheduler);
            }

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
        $invoiceSchedulerDto = $this
            ->entityTools
            ->entityToDto($scheduler);

        $invoiceSchedulerDto->setLastExecution(
            new \DateTime()
        );

        $this->entityTools->persistDto(
            $invoiceSchedulerDto,
            $scheduler,
            true
        );
    }
}