<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\HolidayDate;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Service\HolidayDate\HolidayDateFactory;

class SyncFromCsv
{
    /** @var array{'line': int, 'msg': string}[] */
    private array $errors = [];

    public function __construct(
        private HolidayDateFactory $holidayDateFactory,
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        string $calendarId,
        string $csv,
        string $importerParamsJson
    ): void {

        $csv = trim($csv);

        $rows = array_filter(
            explode(PHP_EOL, $csv),
            fn ($row) => !empty(trim($row))
        );

        $importerParams = $this->initializeImporterParams($importerParamsJson);

        if ($importerParams['ignoreFirst']) {
            array_shift($rows);
        }

        $rowsWithColumns = array_map(
            fn($row) => str_getcsv(
                $row,
                $importerParams['delimiter'],
                $importerParams['enclosure'],
                $importerParams['escape']
            ),
            $rows
        );

        foreach ($rowsWithColumns as $k => $row) {
            $columnCountMatches = is_array($row) && count($row) === count($importerParams['columns']);
            if (!$columnCountMatches) {
                $this->addError($k + 1, 'Wrong column count or wrong separator');
                continue;
            }

            $row = array_combine($importerParams['columns'], $row);
            $this->persistHolidayDateItem(
                $row,
                $k,
                $calendarId
            );
        }
    }

    /** @return array{'line': int, 'msg': string}[] */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array{
     *     'delimiter': string,
     *     'enclosure': string,
     *     'escape': string,
     *     'columns': string[],
     *     'ignoreFirst': boolean
     * }
     */
    private function initializeImporterParams(string $importerParamsJson): array
    {
        $importerParams = json_decode($importerParamsJson, true) ?? [];

        return [
            'delimiter' => $importerParams['delimiter'] ?? ',',
            'enclosure' => $importerParams['enclosure'] ?? '"',
            'escape' => $importerParams['escape'] ?? '\\',
            'columns' => $importerParams['columns'] ?? ['name', 'eventDate'],
            'ignoreFirst' => (bool)($importerParams['ignoreFirst'] ?? false)
        ];
    }

    /** @param array<string, null|string> $row */
    private function persistHolidayDateItem(array $row, int $line, string $calendarId): void
    {
        $eventName = $row['name'];
        $eventDate = $row['eventDate'];

        try {
            $holidayDate = $this->holidayDateFactory->fromMassProvisioningCsv(
                $calendarId,
                (string)$eventName,
                (string)$eventDate
            );

            $this->entityTools->persist($holidayDate);
        } catch (\DomainException $e) {
            $this->addError($line + 1, $e->getMessage());
        } catch (\Exception $e) {
            $this->addError($line + 1, 'Unknown error');
        }
    }

    private function addError(int $line, string $msg): void
    {
        $this->errors[] = [
            'line' => $line,
            'msg' => $msg
        ];
    }
}
