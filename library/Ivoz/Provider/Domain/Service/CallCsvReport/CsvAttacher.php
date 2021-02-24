<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\BillableCall\CsvExporter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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

    /**
     * @return void
     */
    public function execute(CallCsvReportInterface $callCsvReport)
    {
        $isNew = $callCsvReport->isNew();
        if (!$isNew) {
            return;
        }

        $scheduler = $callCsvReport->getCallCsvScheduler();
        if (!$scheduler) {
            return;
        }

        $inDate = $callCsvReport->getInDate();
        $outDate = $callCsvReport->getOutDate();

        $company = $callCsvReport->getCompany();
        $brand = $callCsvReport->getBrand();

        $csvContent = $this->csvExporter->execute(
            $inDate,
            $outDate,
            $company,
            $brand,
            $scheduler
        );

        $csvContent = $this->cleanSensitiveDataIfNecessary(
            $csvContent,
            $brand,
            $company
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

    private function cleanSensitiveDataIfNecessary(
        string $csv,
        BrandInterface $brand = null,
        CompanyInterface $company = null
    ): string {
        if ($brand) {
            return $csv;
        }

        if (!$company) {
            return $csv;
        }

        if ($company->getShowInvoices()) {
            return $csv;
        }

        $rows = $this->csvToArray($csv);
        if (empty($rows)) {
            return $csv;
        }

        foreach ($rows as $key => $val) {
            $rows[$key]['price'] = null;
        }

        return $this->arrayToCsv($rows);
    }

    private function csvToArray(string $csv): array
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);

        return $serializer->decode($csv, 'csv');
    }

    private function arrayToCsv(array $data): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);

        return $serializer->encode($data, 'csv');
        ;
    }
}
