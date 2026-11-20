<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Service\User;

class CsvRowsWriter
{
    public const FORMULA_PREFIXES = ['=', '+', '-', '@', "\t", "\r"];
    private const DELIMITER = ';';
    private const FORMULA_GUARD = "'";

    /**
     * @param list<list<string>> $rows
     */
    public function execute(array $rows): string
    {
        $stream = fopen('php://memory', 'r+');
        if ($stream === false) {
            throw new \RuntimeException('Unable to open the csv stream');
        }

        foreach ($rows as $row) {
            fputcsv(
                $stream,
                array_map(fn (string $field): string => $this->escapeFormula($field), $row),
                self::DELIMITER
            );
        }

        rewind($stream);
        $csv = (string) stream_get_contents($stream);
        fclose($stream);

        return CsvRowsParser::UTF8_BOM . $csv;
    }

    private function escapeFormula(string $field): string
    {
        $looksLikeFormula = $field !== '' && in_array($field[0], self::FORMULA_PREFIXES, true);
        if ($looksLikeFormula) {
            return self::FORMULA_GUARD . $field;
        }

        return $field;
    }
}
