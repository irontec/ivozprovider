<?php

namespace spec\Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Recoder;
use Ivoz\Provider\Domain\Service\MusicOnHold\SendRecodingOrder;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
