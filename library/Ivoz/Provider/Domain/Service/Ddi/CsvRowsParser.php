<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\Ddi;

class CsvRowsParser
{
    private const UTF8_BOM = "\xEF\xBB\xBF";

    /**
     * @return array<int, string>
     * @throws \DomainException
     */
    public function parse(string $csv): array
    {
        if (str_starts_with($csv, self::UTF8_BOM)) {
            $csv = substr($csv, strlen(self::UTF8_BOM));
        }

        /** @var list<string> $lines */
        $lines = preg_split("/\r\n|\n|\r/", $csv);

        $rows = [];
        foreach ($lines as $index => $line) {
            $number = trim($line);
            if ($number === '') {
                continue;
            }

            $rows[$index] = $number;
        }

        if (empty($rows)) {
            throw new \DomainException('The file is empty');
        }

        return $rows;
    }
}
