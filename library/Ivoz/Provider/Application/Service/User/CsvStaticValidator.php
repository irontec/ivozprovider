<?php

declare(strict_types=1);

namespace Ivoz\Provider\Application\Service\User;

class CsvStaticValidator
{
    /**
     * @throws \Exception
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
    }
}
