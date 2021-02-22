<?php

namespace spec\Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Service\Locution\SendRecodingOrder;
use Ivoz\Provider\Infrastructure\Gearman\Jobs\Recoder;
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
