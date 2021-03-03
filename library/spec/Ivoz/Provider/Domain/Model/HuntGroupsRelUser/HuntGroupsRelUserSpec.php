<?php

namespace spec\Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class HuntGroupsRelUserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var HuntGroupsRelUserDto
     */
    private $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    public function let()
    {
        $this->dto = new HuntGroupsRelUserDto();

        $huntGroupDto = new HuntGroupDto();
        $huntGroup = $this->getTestDouble(
            HuntGroupInterface::class
        );
        $this->getterProphecy(
            $huntGroup,
            [
                'getStrategy' => 'roundRobin',
            ],
            false
        );

        $userDto = new UserDto();
        $user = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->dto
            ->setPriority(1)
            ->setTimeoutTime(1)
            ->setRouteType('user')
            ->setHuntGroup($huntGroupDto)
            ->setUser($userDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$huntGroupDto, $huntGroup->reveal()],
            [$userDto, $user->reveal()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HuntGroupsRelUser::class);
    }

    function it_throws_exception_on_empty_timeout()
    {
        $dto = clone $this->dto;
        $dto->setTimeoutTime(null);

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
    }

    function it_throws_exception_on_empty_priority()
    {
        $dto = clone $this->dto;
        $dto->setPriority(null);

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
    }

    function it_allows_empty_timeout_and_priority_with_ringall_strategy()
    {
        $huntGroupDto = new HuntGroupDto();
        /** @var HuntGroupInterface $huntGroup */
        $huntGroup = $this->getterProphecy(
            $this->getTestDouble(
                HuntGroupInterface::class
            ),
            [
                'getStrategy' => HuntGroupInterface::STRATEGY_RINGALL,
            ],
            true
        );

        $dto = clone $this->dto;
        $dto
            ->setTimeoutTime(null)
            ->setPriority(null)
            ->setHuntGroup($huntGroupDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$huntGroupDto, $huntGroup->reveal()]
            ]);

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
    }

    function it_allows_empty_priority_with_random_strategy()
    {
        $dto = clone $this->dto;

        $huntGroupDto = new HuntGroupDto();
        /** @var HuntGroupInterface $huntGroup */
        $huntGroup = $this->getTestDouble(
            HuntGroupInterface::class
        );
        $huntGroup
            ->getStrategy()
            ->willReturn(
                HuntGroupInterface::STRATEGY_RANDOM
            );

        $dto
            ->setPriority(null)
            ->setHuntGroup($huntGroupDto);

        $this->transformer->appendFixedTransforms([
            [$huntGroupDto, $huntGroup]
        ]);

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
    }
}
