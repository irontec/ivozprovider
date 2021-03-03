<?php

namespace spec\Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class ExtensionSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        CompanyInterface $company
    ) {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(
            Company::class
        );

        $this->dto = $dto = new ExtensionDto();
        $dto
            ->setNumber('123')
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
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

    function it_resets_routes_but_current()
    {
        $huntGroupDto = new HuntGroupDto();
        $huntGroup = $this->getInstance(HuntGroup::class);

        $userDto = new UserDto();
        $user = $this->getInstance(User::class);

        $queueDto = new QueueDto();
        $queue = $this->getInstance(Queue::class);

        $conferenceRoomDto = new ConferenceRoomDto();
        $conferenceRoom = $this->getInstance(ConferenceRoom::class);

        $dto = clone $this->dto;
        $dto
            ->setRouteType('ivr')
            ->setFriendValue('1')
            ->setHuntGroup($huntGroupDto)
            ->setUser($userDto)
            ->setConferenceRoom($conferenceRoomDto)
            ->setQueue($queueDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$huntGroupDto, $huntGroup],
                [$userDto, $user],
                [$conferenceRoomDto, $conferenceRoom],
                [$queueDto, $queue],
            ]);

        $this->updateFromDto(
            $dto,
            $this->transformer
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
