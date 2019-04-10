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

    public function execute(CallCsvReportInterface $callCsvReport)
    {
        $isNew = $callCsvReport->isNew();
        if (!$isNew) {
            return;
        }

        $inDate = $callCsvReport->getInDate();
        $outDate = $callCsvReport->getOutDate();

        $scheduler = $callCsvReport->getCallCsvScheduler();
        $company = $callCsvReport->getCompany();
        $brand = $callCsvReport->getBrand();

        $direction = $scheduler
            ? $scheduler->getCallDirection()
            : null;

        $csvContent = $this->csvExporter->execute(
            $inDate,
            $outDate,
            $company,
            $brand,
            $direction
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

        $timezone = new \DateTimeZone(
            $callCsvReport->getTimezone()->getTz()
        );
        $inDate->setTimezone($timezone);
        $outDate->setTimezone($timezone);

        $name = $company
            ? $company->getName()
            : $brand->getName();

        $fileName =
            $name
            . '-'
            . $inDate->format('Ymd')
            . '-'
            . $outDate->format('Ymd')
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
