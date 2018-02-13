<?php

namespace spec\Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Provider\Domain\Service\Locution\SendRecodingOrder;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Recoder;

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
        throw new PendingException();
    }
}
