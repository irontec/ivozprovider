<?php

namespace spec\Ivoz\Provider\Domain\Model\ChannelUsage;

use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsageEvent;
use PhpSpec\ObjectBehavior;

class ChannelUsageEventSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('fromWire', ['A:1767225610:1:2:7']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ChannelUsageEvent::class);
    }

    function it_reads_an_admission_off_the_wire()
    {
        $this->isAdmission()->shouldBe(true);
        $this->isHangup()->shouldBe(false);
        $this->isBlock()->shouldBe(false);

        $this->getTimestamp()->shouldBe(1767225610);
        $this->getBrandId()->shouldBe(1);
        $this->getCompanyId()->shouldBe(2);
        $this->getOccupancy()->shouldBe(7);
    }

    function it_keeps_the_original_wire_entry()
    {
        // The parser drops malformed entries, so callers cannot infer how many raw entries a
        // set of events came from and need the originals to put back what they defer.
        $this->getWire()->shouldBe('A:1767225610:1:2:7');
    }

    function it_reads_a_hangup_without_occupancy()
    {
        $event = $this::fromWire('H:1767225610:1:2');

        $event->isHangup()->shouldBe(true);
        $event->getOccupancy()->shouldBe(null);
    }

    function it_tells_which_limit_rejected_a_call()
    {
        $byBrand = $this::fromWire('B:1767225610:1:2:brand');
        $byBrand->isBlock()->shouldBe(true);
        $byBrand->isBlockedByBrand()->shouldBe(true);

        $byCompany = $this::fromWire('B:1767225610:1:2:company');
        $byCompany->isBlock()->shouldBe(true);
        $byCompany->isBlockedByBrand()->shouldBe(false);
    }

    function it_answers_which_company_it_belongs_to()
    {
        $this->belongsTo(2)->shouldBe(true);
        $this->belongsTo(3)->shouldBe(false);
    }

    function it_answers_whether_its_bucket_is_already_closed()
    {
        $this->happenedBefore(1767225611)->shouldBe(true);
        $this->happenedBefore(1767225610)->shouldBe(false);
    }

    function it_rejects_entries_it_cannot_read()
    {
        $this::fromWire('nonsense')->shouldBeNull();
        $this::fromWire('X:1767225610:1:2')->shouldBeNull();
        $this::fromWire('A:0:1:2')->shouldBeNull();
        $this::fromWire('A:1767225610:0:2')->shouldBeNull();
        $this::fromWire('A:1767225610:1:0')->shouldBeNull();
        $this::fromWire('A:1767225610:1')->shouldBeNull();
    }
}
