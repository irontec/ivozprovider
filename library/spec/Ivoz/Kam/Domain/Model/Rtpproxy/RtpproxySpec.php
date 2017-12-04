<?php

namespace spec\Ivoz\Kam\Domain\Model\Rtpproxy;

use Ivoz\Kam\Domain\Model\Rtpproxy\Rtpproxy;
use Ivoz\Kam\Domain\Model\Rtpproxy\RtpproxyDTO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RtpproxySpec extends ObjectBehavior
{
    protected $dto;

    function let() {

        $this->dto = $dto = new RtpproxyDTO();

        $dto->setSetid('123')
            ->setUrl('something')
            ->setFlags(1)
            ->setWeight(1);

        $this->beConstructedThrough(
            'fromDTO',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Rtpproxy::class);
    }
}
