<?php

namespace spec\Ivoz\Provider\Application\Service\User;

use Ivoz\Provider\Application\Service\User\CsvStaticValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CsvStaticValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CsvStaticValidator::class);
    }

    function it_executable()
    {
        $input = array_map(
            'str_getcsv',
            [
                'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
                'John,Doe,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,as002'
            ]
        );

        $this
            ->shouldNotThrow('Exception')
            ->during('execute', [$input]);
    }

    function it_checks_column_number()
    {
        $input = array_map(
            'str_getcsv',
            [
            'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
            'John,Doe,jon@irontec.com,'
            ]
        );

        $exception = new \DomainException(
            '11 column were expected but 4 found at line 2'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [$input]);
    }

    function it_checks_unique_full_names()
    {
        $input = array_map(
            'str_getcsv',
            [
                'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
                'Name,Lastname,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,as002'
            ]
        );

        $exception = new \DomainException(
            'Duplicated full name found: Name Lastname'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [$input]);
    }

    function it_checks_unique_emails()
    {
        $input = array_map(
            'str_getcsv',
            [
                'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
                'John,Doe,name@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,as002'
            ]
        );

        $exception = new \DomainException(
            'Duplicated user email found: name@irontec.com'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [$input]);
    }

    function it_checks_unique_terminal_names()
    {
        $input = array_map(
            'str_getcsv',
            [
                'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
                'John,Doe,john@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000053,2003,ES,946002051,as002'
            ]
        );

        $exception = new \DomainException(
            'Duplicated terminal name found: terminalName'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [$input]);
    }

    function it_checks_unique_macs()
    {
        $input = array_map(
            'str_getcsv',
            [
                'Name,Lastname,name@irontec.com,terminalName,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2002,ES,946002050,as002',
                'John,Doe,jon@irontec.com,terminalName2,Z7+KJn8m3k,YealinkT21P_E2,a00000000052,2003,ES,946002051,as002'
            ]
        );

        $exception = new \DomainException(
            'Duplicated mac found: a00000000052'
        );

        $this
            ->shouldThrow($exception)
            ->during('execute', [$input]);
    }
}
