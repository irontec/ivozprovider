<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\Contact;

class CsvRowsParser
{
    private const UTF8_BOM = "\xEF\xBB\xBF";
    private const DELIMITERS = [',', ';'];

    /**
     * Header and data rows indexed by their zero based line in the file
     *
     * @return array<int, string[]>
     * @throws \DomainException when the file has no rows
     */
    public function parse(string $csv): array
    {
        $csv = $this->removeBom($csv);
        /** @var list<string> $lines */
        $lines = preg_split("/\r\n|\n|\r/", $csv);
        $delimiter = $this->detectDelimiter($lines);

        $rows = [];
        foreach ($lines as $index => $line) {
            $fields = array_map(
                fn (?string $field): string => (string) $field,
                str_getcsv($line, $delimiter)
            );

            if ($this->isEmptyRow($fields)) {
                continue;
            }

            $rows[$index] = $fields;
        }

        if (empty($rows)) {
            throw new \DomainException('The file is empty');
        }

        return $rows;
    }

    private function removeBom(string $csv): string
    {
        if (!str_starts_with($csv, self::UTF8_BOM)) {
            return $csv;
        }

        return substr($csv, strlen(self::UTF8_BOM));
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
}
