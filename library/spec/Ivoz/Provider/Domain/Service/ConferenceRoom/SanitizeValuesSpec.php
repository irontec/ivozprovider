<?php

namespace spec\Ivoz\Provider\Domain\Service\ConferenceRoom;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Service\ConferenceRoom\SanitizeValues;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SanitizeValuesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SanitizeValues::class);
    }

    function it_resets_pincode_when_not_pin_protected(
        ConferenceRoomInterface $entity
    ) {
        $entity
            ->getPinProtected()
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->setPinCode(null)
            ->shouldBecalled();

        $this->execute($entity, true);
    }


    function it_doesnt_change_pincode_if_pin_protected(
        ConferenceRoomInterface $entity
    ) {
        $entity
            ->getPinProtected()
            ->willReturn(true)
            ->shouldBeCalled();

        $entity
            ->setPinCode(null)
            ->shouldNotBecalled();

        $this->execute($entity, true);
    }
}
