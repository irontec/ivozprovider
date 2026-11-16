<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\User;

class CsvStaticValidator
{
    /**
     * @param array<int, string[]> $rows
     * @throws \DomainException
     *
     * @return void
     */
    public function execute(array $rows)
    {
        foreach ($rows as $k => $fields) {
            if (count($fields) !== 11) {
                $errorMsg = sprintf(
                    '11 column were expected but %d found at line %d',
                    count($fields),
                    $k + 1
                );

                throw new \DomainException($errorMsg);
            }
        }

        $fullNames = array_map(
            function ($row): string {
                return $row[0] . ' ' . $row[1];
            },
            $rows
        );
        $uniqueFullNames = array_unique($fullNames);
        if (count($uniqueFullNames) < count($fullNames)) {
            $diff = array_diff_assoc($fullNames, $uniqueFullNames);
            $errorMsg = sprintf(
                'Duplicated full name found: %s',
                implode(', ', $diff)
            );

            throw new \DomainException($errorMsg);
        }

        $uniqueColumns = [
            2 => 'user email',
            3 => 'terminal name',
            6 => 'mac',
            7 => 'extension',
        ];

        foreach ($uniqueColumns as $pos => $name) {
            $values = array_filter(
                array_column($rows, $pos)
            );
            $uniqueValues = array_unique($values);
            if (count($uniqueValues) < count($values)) {
                $diff = array_diff_assoc($values, $uniqueValues);
                $errorMsg = sprintf(
                    'Duplicated %s found: %s',
                    $name,
                    implode(',  ', $diff)
                );

                throw new \DomainException($errorMsg);
            }
        }

        $this->assertUniqueDdis($rows);
    }

    /**
     * @param array<int, string[]> $rows
     * @throws \DomainException
     */
    private function assertUniqueDdis(array $rows): void
    {
        $ddis = [];
        foreach ($rows as $fields) {
            [$country, $number] = [$fields[8], $fields[9]];
            if ($number === '') {
                continue;
            }

            $ddis[] = $country . ' ' . $number;
        }

        $uniqueDdis = array_unique($ddis);
        if (count($uniqueDdis) < count($ddis)) {
            $duplicated = array_map(
                fn (string $ddi): string => trim($ddi),
                array_diff_assoc($ddis, $uniqueDdis)
            );

            throw new \DomainException(
                sprintf(
                    'Duplicated ddi number found: %s',
                    implode(',  ', $duplicated)
                )
            );
        }
    }
}
