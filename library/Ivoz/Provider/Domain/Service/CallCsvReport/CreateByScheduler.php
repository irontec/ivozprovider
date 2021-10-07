<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\SetExecutionError;
use Ivoz\Provider\Domain\Service\CallCsvScheduler\UpdateLastExecutionDate;
use Psr\Log\LoggerInterface;

class CreateByScheduler
{
    public function __construct(
        private EntityTools $entityTools,
        private LoggerInterface $logger,
        private UpdateLastExecutionDate $updateLastExecutionDate,
        private SetExecutionError $setExecutionError
    ) {
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(CallCsvSchedulerInterface $scheduler)
    {
        try {
            $this->createCallCsvReport($scheduler);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $name = $scheduler->getName();
            $this->logger->error(
                "Call CSV scheduler #${name} has failed: " . $error
            );

            $this->setExecutionError->execute(
                $scheduler,
                $error
            );

            throw $e;
        } finally {
            $this->updateLastExecutionDate->execute(
                $scheduler
            );
        }
    }

    /**
     * @param CallCsvSchedulerInterface $scheduler
     * @return CallCsvReportInterface
     */
    private function createCallCsvReport(CallCsvSchedulerInterface $scheduler)
    {
        $outDate = $scheduler->getNextExecution();
        $outDate->setTimezone(
            new \DateTimeZone(
                $scheduler->getTimezone()->getTz()
            )
        );
        $outDate->setTime(0, 0, 0);
        $outDate->modify('1 second ago');

        $inDate = DateTimeHelper::sub(
            $outDate,
            $scheduler->getInterval()
        );
        $inDate->modify('+1 second');

        // Back to UTC
        $utc = new \DateTimeZone('UTC');
        $outDate->setTimezone($utc);
        $inDate->setTimezone($utc);

        $company = $scheduler->getCompany();
        $companyId = $company
            ? $company->getId()
            : null;

        $brand = $scheduler->getBrand();
        $brandId = $brand
            ? $brand->getId()
            : null;

        $reportDto = new CallCsvReportDto();
        $reportDto
            ->setInDate($inDate)
            ->setOutDate($outDate)
            ->setCreatedOn(new \DateTime('now', $utc))
            ->setBrandId($brandId)
            ->setCompanyId($companyId)
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
}
