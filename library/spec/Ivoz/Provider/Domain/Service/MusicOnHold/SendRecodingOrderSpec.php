<?php

namespace spec\Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Infrastructure\Redis\Job\Recoder;
use Ivoz\Provider\Domain\Service\MusicOnHold\SendRecodingOrder;
use PhpSpec\ObjectBehavior;

class SendRecodingOrderSpec extends ObjectBehavior
{
    /**
     * @var Recoder
     */
    protected $recoder;

    public function let(
        Recoder $recoder
    ) {
        $this->beConstructedWith($recoder);
        $this->recoder = $recoder;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendRecodingOrder::class);
    }
}
