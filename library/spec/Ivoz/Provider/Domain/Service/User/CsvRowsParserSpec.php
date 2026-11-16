<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Service\User\CsvRowsParser;
use PhpSpec\ObjectBehavior;

class CsvRowsParserSpec extends ObjectBehavior
{
    private const ROW = 'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002';

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowsParser::class);
    }

    function it_splits_lines_and_comma_separated_columns()
    {
        $this
            ->parse(self::ROW . "\n" . 'John,Doe,jon@irontec.com,,,,,,,,')
            ->shouldReturn([
                0 => str_getcsv(self::ROW),
                1 => ['John', 'Doe', 'jon@irontec.com', '', '', '', '', '', '', '', ''],
            ]);
    }

    function it_accepts_semicolon_separated_columns()
    {
        $this
            ->parse(str_replace(',', ';', self::ROW))
            ->shouldReturn([
                0 => str_getcsv(self::ROW),
            ]);
    }

    function it_strips_the_utf8_bom()
    {
        $this
            ->parse("\xEF\xBB\xBF" . self::ROW)
            ->shouldReturn([
                0 => str_getcsv(self::ROW),
            ]);
    }

    function it_converts_windows_1252_files_to_utf8()
    {
        $this
            ->parse("Ni\xF1o,P\xE9rez,nino@irontec.com,,,,,,,,")
            ->shouldReturn([
                0 => ['Niño', 'Pérez', 'nino@irontec.com', '', '', '', '', '', '', '', ''],
            ]);
    }

    function it_accepts_windows_line_endings_and_trims_values()
    {
        $this
            ->parse(" Name , Lastname ,name@irontec.com,,,,,,,,\r\nJohn,Doe,jon@irontec.com,,,,,,,,\r\n")
            ->shouldReturn([
                0 => ['Name', 'Lastname', 'name@irontec.com', '', '', '', '', '', '', '', ''],
                1 => ['John', 'Doe', 'jon@irontec.com', '', '', '', '', '', '', '', ''],
            ]);
    }

    function it_skips_empty_rows_keeping_the_original_line_numbers()
    {
        $this
            ->parse(self::ROW . "\n\n,,,,,,,,,,\n" . 'John,Doe,jon@irontec.com,,,,,,,,')
            ->shouldReturn([
                0 => str_getcsv(self::ROW),
                3 => ['John', 'Doe', 'jon@irontec.com', '', '', '', '', '', '', '', ''],
            ]);
    }

    function it_skips_the_optional_header()
    {
        $header = 'name,lastname,email,terminal name,terminal password,terminal model,mac,extension,ddi country,ddi number,ddi provider';

        $this
            ->parse($header . "\n" . self::ROW)
            ->shouldReturn([
                1 => str_getcsv(self::ROW),
            ]);
    }

    function it_rejects_empty_files()
    {
        $this
            ->shouldThrow(new \DomainException('The file is empty'))
            ->during('parse', ["\xEF\xBB\xBF\n,,,,,,,,,,\n"]);
    }
}
