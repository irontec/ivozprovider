<?php

namespace spec\Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\Company\Company;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompanySpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            'vpbx',
            '',
            '',
            'static',
            0,
            '',
            '',
            '',
            '',
            ''
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Company::class);
    }

    function it_throws_exception_on_non_numeric_record_code()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setOnDemandRecordCode', ['abcd']);

        $this
            ->shouldThrow('\Exception')
            ->during('setOnDemandRecordCode', ['123a']);
    }

    function it_accepts_numeric_record_code()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setOnDemandRecordCode', ['123']);
    }
}
