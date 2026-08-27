<?php

namespace spec\Ivoz\Provider\Domain\Service\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;
use Ivoz\Provider\Domain\Service\ChannelUsage\ChannelUsageEventParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class ChannelUsageEventParserSpec extends ObjectBehavior
{
    protected $logger;

    public function let(LoggerInterface $logger)
    {
        $this->logger = $logger;

        $this->beConstructedWith($logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ChannelUsageEventParser::class);
    }

    function it_turns_raw_entries_into_events()
    {
        $events = $this->parse([
            'A:1767225610:1:2:7',
            'H:1767225620:1:2',
        ]);

        $events->shouldHaveCount(2);
        $events[0]->shouldBeAnInstanceOf(ChannelUsageEvent::class);
        $events[0]->getOccupancy()->shouldBe(7);
        $events[1]->isHangup()->shouldBe(true);
    }

    function it_drops_malformed_entries_and_warns()
    {
        $this
            ->logger
            ->warning(Argument::containingString('discarded 3 malformed'))
            ->shouldBeCalled();

        $this
            ->parse([
                'nonsense',
                'X:1767225610:1:2',
                'A:0:1:2',
                'A:1767225610:1:2:3',
            ])
            ->shouldHaveCount(1);
    }

    function it_does_not_warn_when_everything_parses()
    {
        $this
            ->logger
            ->warning(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->parse(['H:1767225610:1:2'])
            ->shouldHaveCount(1);
    }

    function it_returns_nothing_for_an_empty_queue()
    {
        $this->parse([])->shouldBe([]);
    }
}
