<?php

namespace spec\Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Service\Ddi\CsvRowsParser;
use PhpSpec\ObjectBehavior;

class CsvRowsParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowsParser::class);
    }

    function it_returns_one_number_per_line_indexed_by_its_file_line()
    {
        $this
            ->parse("944048182\n944048183\n944048184")
            ->shouldBe([
                0 => '944048182',
                1 => '944048183',
                2 => '944048184',
            ]);
    }

    function it_trims_the_spaces_around_the_number()
    {
        $this
            ->parse("  944048182 \n\t944048183")
            ->shouldBe([
                0 => '944048182',
                1 => '944048183',
            ]);
    }

    function it_skips_empty_lines_keeping_the_original_line_numbers()
    {
        $this
            ->parse("944048182\n\n   \n944048183\n")
            ->shouldBe([
                0 => '944048182',
                3 => '944048183',
            ]);
    }

    function it_strips_the_utf8_bom()
    {
        $this
            ->parse("\xEF\xBB\xBF944048182\n944048183")
            ->shouldBe([
                0 => '944048182',
                1 => '944048183',
            ]);
    }

    function it_accepts_windows_line_endings()
    {
        $this
            ->parse("944048182\r\n944048183\r\n")
            ->shouldBe([
                0 => '944048182',
                1 => '944048183',
            ]);
    }

    function it_keeps_invalid_values_for_the_importer_to_report()
    {
        $this
            ->parse("+34944048182\nabc")
            ->shouldBe([
                0 => '+34944048182',
                1 => 'abc',
            ]);
    }

    function it_rejects_empty_files()
    {
        $this
            ->shouldThrow(new \DomainException('The file is empty'))
            ->during('parse', ["\xEF\xBB\xBF\n\n"]);
    }
}
