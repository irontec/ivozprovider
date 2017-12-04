<?php

namespace spec\Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Service\MusicOnHold\SendRecodingOrder;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SendRecodingOrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SendRecodingOrder::class);
        throw new PendingException();
    }
}
