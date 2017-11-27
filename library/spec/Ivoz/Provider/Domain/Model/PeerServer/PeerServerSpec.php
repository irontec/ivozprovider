<?php

namespace spec\Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Provider\Domain\Model\PeerServer\PeerServer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PeerServerSpec extends ObjectBehavior
{

    function let() {
        $this->beConstructedWith(
            'yes'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PeerServer::class);
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

    function it_throws_exception_on_invalid_params()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setParams', ['Something']);

        $this
            ->shouldThrow('\Exception')
            ->during('setParams', ['Something wrong']);

        $this
            ->shouldThrow('\Exception')
            ->during('setParams', [';']);
    }

    function it_accepts_valid_params()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setParams', [';somethingRight']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setParams', [null]);
    }
}
