<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\Extension;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;

class SyncFromCsv
{
    public function __construct(
        private ExtensionFactory $extensionFactory,
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        int $companyId,
        string $csv
    ): void {

        $rows = explode(
            PHP_EOL,
            trim($csv)
        );

        /** @var array<int, string> $rows */
        foreach ($rows as $k => $row) {
            $row = trim($row);

            if ($row == '' || str_contains($row, 'Extension')) {
                unset($rows[$k]);
                continue;
            }

            $rows[$k] = str_getcsv(trim($row));
        }

        $errors = [];
        $entities = [];
        foreach ($rows as $k => $fields) {
            try {
                $extensionNumber = $fields[0];
                $countryCode = $fields[1];
                $number = $fields[2];
                $code = $fields[3] ?? null;

                $extension = $this->extensionFactory->fromMassProvisioningCsv(
                    companyId: $companyId,
                    extensionNumber: (string) $extensionNumber,
                    countryCode: $countryCode,
                    number: $number,
                    code: $code
                );
                $entities[] = $extension;
            } catch (\Exception $e) {
                $errors[$k + 1] = $e->getMessage();
                continue;
            }
        }

        $this->entityTools->persistFromArray($entities);

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
