<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\User;

class CsvRowsParser
{
    private const UTF8_BOM = "\xEF\xBB\xBF";
    private const DELIMITERS = [',', ';'];
    private const HEADER_START = ['name', 'lastname', 'email'];

    /**
     * @return array<int, string[]>
     * @throws \DomainException when the file has no data rows
     */
    public function parse(string $csv): array
    {
        $csv = $this->toUtf8($csv);
        /** @var list<string> $lines */
        $lines = preg_split("/\r\n|\n|\r/", $csv);
        $delimiter = $this->detectDelimiter($lines);

        $rows = [];
        foreach ($lines as $index => $line) {
            $fields = array_map(
                fn (?string $field): string => trim((string) $field),
                str_getcsv($line, $delimiter)
            );

            if ($this->isEmptyRow($fields)) {
                continue;
            }

            $rows[$index] = $fields;
        }

        $rows = $this->dropHeader($rows);

        if (empty($rows)) {
            throw new \DomainException('The file is empty');
        }

        return $rows;
    }

    private function toUtf8(string $csv): string
    {
        if (str_starts_with($csv, self::UTF8_BOM)) {
            $csv = substr($csv, strlen(self::UTF8_BOM));
        }

        if (!mb_check_encoding($csv, 'UTF-8')) {
            $csv = mb_convert_encoding($csv, 'UTF-8', 'Windows-1252');
        }

        return $csv;
    }

    /**
     * @param list<string> $lines
     */
    private function detectDelimiter(array $lines): string
    {
        $firstLine = '';
        foreach ($lines as $line) {
            if (trim($line) !== '') {
                $firstLine = $line;
                break;
            }
        }

        $delimiter = self::DELIMITERS[0];
        $maxCount = substr_count($firstLine, $delimiter);
        foreach (self::DELIMITERS as $candidate) {
            $count = substr_count($firstLine, $candidate);
            if ($count > $maxCount) {
                $delimiter = $candidate;
                $maxCount = $count;
            }
        }

        return $delimiter;
    }

    /**
     * @param string[] $fields
     */
    private function isEmptyRow(array $fields): bool
    {
        $filled = array_filter(
            $fields,
            fn (string $field): bool => $field !== ''
        );

        return count($filled) === 0;
    }

    /**
     * @param array<int, string[]> $rows
     * @return array<int, string[]>
     */
    private function dropHeader(array $rows): array
    {
        $firstKey = array_key_first($rows);
        if ($firstKey === null) {
            return $rows;
        }

        $firstCells = array_map(
            'strtolower',
            array_slice($rows[$firstKey], 0, count(self::HEADER_START))
        );

        if ($firstCells === self::HEADER_START) {
            unset($rows[$firstKey]);
        }

        return $rows;
    }
}
