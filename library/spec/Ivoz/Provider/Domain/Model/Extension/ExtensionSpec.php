<?php

namespace spec\Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ExtensionSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let()
    {

        $this->dto = $dto = new ExtensionDto();
        $dto->setNumber('123');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Extension::class);
    }

    function it_throws_exception_on_invalid_number_values()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setNumber', ['*123']);
    }

    function it_accepts_numeric_number_values()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['1$']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['123*']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumber', ['123456789']);
    }

    function it_resets_routes_but_current(
        HuntGroupInterface $huntGroup,
        UserInterface $user,
        ConferenceRoomInterface $conferenceRoom,
        QueueInterface $queue
    ) {
        $dto = clone $this->dto;
        $dto->setRouteType('ivr');
        $dto->setFriendValue('1');

        $this->hydrate(
            $this->dto,
            [
                'huntGroup'      => $huntGroup->getWrappedObject(),
                'user'           => $user->getWrappedObject(),
                'conferenceRoom' => $conferenceRoom->getWrappedObject(),
                'queue'          => $queue->getWrappedObject()
            ]
        );

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this->getHuntGroup()
            ->shouldBe(null);

        $this->getUser()
            ->shouldBe(null);

        $this->getConferenceRoom()
            ->shouldBe(null);

        $this->getNumberValue()
            ->shouldBe(null);

        $this->getFriendValue()
            ->shouldBe(null);

        $this->getQueue()
            ->shouldBe(null);
    }
}
