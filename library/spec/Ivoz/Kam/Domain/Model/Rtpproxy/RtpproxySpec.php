<?php

namespace spec\Ivoz\Kam\Domain\Model\Rtpproxy;

use Ivoz\Kam\Domain\Model\Rtpproxy\Rtpproxy;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RtpproxySpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            '123',
            'something',
            1,
            1
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Rtpproxy::class);
    }
}
