<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\HolidayDate;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Service\HolidayDate\HolidayDateFactory;

class SyncFromCsv
{
    public function __construct(
        private HolidayDateFactory $holidayDateFactory,
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        string $calendarId,
        string $csv
    ): void {

        $csv = trim($csv);

        $rows = explode(
            PHP_EOL,
            $csv
        );

        /** @var array<int, string>  $rows */
        foreach ($rows as $k => $row) {
            $row = trim($row);

            if ($row == '') {
                unset($rows[$k]);
                continue;
            }

            $rows[$k] = str_getcsv(trim($row));
        }

        $errors = [];
        foreach ($rows as $k => $fields) {
            try {
                $eventName = $fields[0];
                $eventDate = $fields[1];

                $holidayDate = $this->holidayDateFactory->fromMassProvisioningCsv(
                    $calendarId,
                    (string) $eventName,
                    (string) $eventDate
                );
                $this->entityTools->persist($holidayDate);
            } catch (\Exception $e) {
                $errors[$k + 1] = $e->getMessage();
                continue;
            }
        }

        if (count($errors) > 0) {
            $errorMsgs = [];
            foreach ($errors as $key => $val) {
                $errorMsgs[] = $key . ' => ' . $val;
            }
            $errorMsg = implode("\n", $errorMsgs);
            throw new \Exception(
                $errorMsg,
                count($errors)
            );
        }
    }
}
