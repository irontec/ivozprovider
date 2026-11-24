<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Service\User\CsvRowsParser;
use Ivoz\Provider\Domain\Service\User\CsvRowsWriter;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class CsvRowsWriterSpec extends ObjectBehavior
{
    private const BOM = "\xEF\xBB\xBF";

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowsWriter::class);
    }

    function it_writes_one_semicolon_separated_line_per_row_with_a_utf8_bom()
    {
        $this
            ->execute([
                ['name', 'lastname', 'email'],
                ['Alice', 'Allison', 'alice@example.com'],
                ['Bob', 'Bobson', ''],
            ])
            ->shouldBe(
                self::BOM
                . "name;lastname;email\n"
                . "Alice;Allison;alice@example.com\n"
                . "Bob;Bobson;\n"
            );
    }

    function it_quotes_values_with_spaces_separators_or_quotes()
    {
        $this
            ->execute([
                ['terminal name', "O'Brien; Jr", 'Núñez "Pepe"'],
            ])
            ->shouldBe(
                self::BOM
                . "\"terminal name\";\"O'Brien; Jr\";\"Núñez \"\"Pepe\"\"\"\n"
            );
    }

    function it_protects_formula_like_values_with_a_leading_quote()
    {
        $this
            ->execute([
                ['=Sum', '-Dash', '+1', '@at', 'plain', ''],
            ])
            ->shouldBe(
                self::BOM
                . "'=Sum;'-Dash;'+1;'@at;plain;\n"
            );
    }

    function it_writes_what_the_parser_reads_back()
    {
        $rows = [
            ['=Sum', "O'Brien; Jr", 'Núñez "Pepe"', '-944000311'],
        ];

        $csv = $this->execute($rows)->getWrappedObject();
        $parsed = (new CsvRowsParser())->parse($csv);

        if (array_values($parsed) !== $rows) {
            throw new FailureException('The parser does not read back the written rows');
        }
    }
}
