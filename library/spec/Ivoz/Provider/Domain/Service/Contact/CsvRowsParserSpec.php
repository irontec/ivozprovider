<?php

namespace spec\Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Provider\Domain\Service\Contact\CsvRowsParser;
use PhpSpec\ObjectBehavior;

class CsvRowsParserSpec extends ObjectBehavior
{
    private const HEADER = 'id,name,lastname';

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowsParser::class);
    }

    function it_splits_lines_and_comma_separated_columns()
    {
        $this
            ->parse(self::HEADER . "\n" . ',Ana,García')
            ->shouldReturn([
                0 => ['id', 'name', 'lastname'],
                1 => ['', 'Ana', 'García'],
            ]);
    }

    function it_accepts_semicolon_separated_columns()
    {
        $this
            ->parse("id;name;lastname\n;Ana;García")
            ->shouldReturn([
                0 => ['id', 'name', 'lastname'],
                1 => ['', 'Ana', 'García'],
            ]);
    }

    function it_strips_the_utf8_bom()
    {
        $this
            ->parse("\xEF\xBB\xBF" . self::HEADER . "\n" . ',Ana,García')
            ->shouldReturn([
                0 => ['id', 'name', 'lastname'],
                1 => ['', 'Ana', 'García'],
            ]);
    }

    function it_accepts_windows_line_endings()
    {
        $this
            ->parse(self::HEADER . "\r\n,Ana,García\r\n")
            ->shouldReturn([
                0 => ['id', 'name', 'lastname'],
                1 => ['', 'Ana', 'García'],
            ]);
    }

    function it_skips_empty_rows_keeping_the_original_line_numbers()
    {
        $this
            ->parse(self::HEADER . "\n\n,,\n" . ',Ana,García')
            ->shouldReturn([
                0 => ['id', 'name', 'lastname'],
                3 => ['', 'Ana', 'García'],
            ]);
    }

    function it_rejects_empty_files()
    {
        $this
            ->shouldThrow(new \DomainException('The file is empty'))
            ->during('parse', ["\xEF\xBB\xBF\n,,\n"]);
    }
}
