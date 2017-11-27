<?php

namespace spec\Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Provider\Domain\Model\Friend\Friend;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FriendSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(
            'Name',
            'Desc',
            'udp',
            'yes',
            1,
            'all',
            'none',
            'invite',
            'rpid',
            'yes',
            'yes'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Friend::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['My Friend']);

        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['$dollar']);

        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['#something']);
    }

    function it_accepts_valid_names()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['MyFriend']);
    }

    function it_throws_exception_on_invalid_ip()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['300.127.127.14']);

        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['aa:bb:cc:dd:ee:ff']);
    }

    function it_accepts_valid_ip()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['80.127.127.14']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['127.0.0.1']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['0.0.0.0']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['2001:db8:a0b:12f0::1']);
    }

    function it_throws_an_exception_on_non_numeric_port()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPort', ['a3']);

        $this
            ->shouldThrow('\Exception')
            ->during('setPort', ['65536']);
    }

    function it_accepts_numeric_port()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPort', ['80']);
    }

    function it_throws_an_exception_on_invalid_password()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPassword', ['1234']);
    }

    function it_accepts_format_compliant_password()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPassword', ['HZhN5z*j48']);
    }

}
