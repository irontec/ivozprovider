<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;
use Symfony\Component\Filesystem\Filesystem;

class CsvAttacher implements CallCsvReportLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CsvExporter
     */
    protected $csvExporter;

    /**
     * @var Filesystem
     */
    protected $fs;

    public function __construct(
        EntityTools $entityTools,
        CsvExporter $csvExporter,
        Filesystem $fs
    ) {
        $this->entityTools = $entityTools;
        $this->csvExporter = $csvExporter;
        $this->fs = $fs;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    public function execute(CallCsvReportInterface $callCsvReport, $isNew)
    {
        if (!$isNew) {
            return;
        }

        $inDate = $callCsvReport->getInDate();
        $outDate = $callCsvReport->getOutDate();

        $company = $callCsvReport->getCompany();
        $csvContent = $this->csvExporter->execute(
            $company,
            $inDate,
            $outDate
        );

        $tmpFilePath = tempnam(
            '/tmp',
            'BillableCallCsv'
        );

        $this
            ->fs
            ->dumpFile($tmpFilePath, $csvContent);

        /** @var CallCsvReportDto $callCsvReportDto */
        $callCsvReportDto = $this->entityTools->entityToDto(
            $callCsvReport
        );

        $scheduler = $callCsvReport->getCallCsvScheduler();
        if ($scheduler) {
            $timezone = new \DateTimeZone(
                $scheduler->getTimezone()->getTz()
            );
            $inDate->setTimezone($timezone);
            $outDate->setTimezone($timezone);
        }

        $fileName =
            $company->getName()
            . '-'
            . $callCsvReport->getInDate()->format('Ymd')
            . '-'
            . $callCsvReport->getOutDate()->format('Ymd')
            . '.csv';

        $callCsvReportDto
            ->setCsvPath($tmpFilePath)
            ->setCsvBaseName($fileName);

        $this->entityTools->updateEntityByDto(
            $callCsvReport,
            $callCsvReportDto
        );
    }
}
