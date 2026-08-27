<?php

namespace spec\Ivoz\Provider\Domain\Service\ChannelUsage;

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

    function it_parses_an_admission_with_its_occupancy()
    {
        $this
            ->parse(['A:1767225610:1:2:7'])
            ->shouldBeLike([
                [
                    'type' => 'A',
                    'ts' => 1767225610,
                    'brandId' => 1,
                    'companyId' => 2,
                    'occ' => 7,
                    'reason' => '',
                    'raw' => 'A:1767225610:1:2:7'
                ]
            ]);
    }

    function it_parses_a_hangup_without_occupancy()
    {
        $this
            ->parse(['H:1767225610:1:2'])
            ->shouldBeLike([
                [
                    'type' => 'H',
                    'ts' => 1767225610,
                    'brandId' => 1,
                    'companyId' => 2,
                    'occ' => null,
                    'reason' => '',
                    'raw' => 'H:1767225610:1:2'
                ]
            ]);
    }

    function it_parses_the_reason_of_a_blocked_call()
    {
        $this
            ->parse(['B:1767225610:1:2:brand'])
            ->shouldBeLike([
                [
                    'type' => 'B',
                    'ts' => 1767225610,
                    'brandId' => 1,
                    'companyId' => 2,
                    'occ' => null,
                    'reason' => 'brand',
                    'raw' => 'B:1767225610:1:2:brand'
                ]
            ]);
    }

    function it_drops_malformed_entries_and_warns()
    {
        $this
            ->logger
            ->warning(Argument::containingString('discarded 4 malformed'))
            ->shouldBeCalled();

        $this
            ->parse([
                'nonsense',
                'X:1767225610:1:2',
                'A:0:1:2',
                'A:1767225610:0:2',
                'A:1767225610:1:2:3',
            ])
            ->shouldHaveCount(1);
    }

    function it_keeps_the_raw_entry_so_the_queue_can_be_trimmed_exactly()
    {
        // The parser drops entries, so the caller cannot infer how many raw entries a set
        // of events came from: it needs the originals back.
        $this
            ->logger
            ->warning(Argument::any())
            ->shouldBeCalled();

        $events = $this->parse([
            'garbage',
            'H:1767225610:1:2',
        ]);

        $events->shouldHaveCount(1);
        $events[0]['raw']->shouldBe('H:1767225610:1:2');
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
}
