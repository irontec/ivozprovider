<?php

namespace spec\Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class HuntGroupsRelUserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var HuntGroupsRelUserDto
     */
    private $dto;

    public function let()
    {
        $this->dto = new HuntGroupsRelUserDto();

        $huntGroup = $this->getTestDouble(
            HuntGroupInterface::class
        );
        $user = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->dto
            ->setPriority(1)
            ->setTimeoutTime(1);

        $this->hydrate(
            $this->dto,
            [
                'huntGroup' => $huntGroup->reveal(),
                'user' => $user->reveal(),
                'routeType' => 'user',
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, new \spec\DtoToEntityFakeTransformer()]
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
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }

    function it_throws_exception_on_empty_priority()
    {
        $dto = clone $this->dto;
        $dto->setPriority(null);

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }

    function it_allows_empty_timeout_and_priority_with_ringall_strategy()
    {
        $dto = clone $this->dto;
        $dto
            ->setTimeoutTime(null)
            ->setPriority(null);

        /** @var HuntGroupInterface $huntGroup */
        $huntGroup = $this->getTestDouble(
            HuntGroupInterface::class
        );

        $huntGroup
            ->getStrategy()
            ->willReturn(HuntGroupInterface::STRATEGY_RINGALL)
            ->shouldBeCalled();

        $this->hydrate(
            $dto,
            ['huntGroup' => $huntGroup->reveal()]
        );

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }

    function it_allows_empty_priority_with_random_strategy()
    {
        $dto = clone $this->dto;
        $dto->setPriority(null);

        /** @var HuntGroupInterface $huntGroup */
        $huntGroup = $this->getTestDouble(
            HuntGroupInterface::class
        );
        $huntGroup
            ->getStrategy()
            ->willReturn(HuntGroupInterface::STRATEGY_RANDOM);

        $this->hydrate(
            $dto,
            ['huntGroup' => $huntGroup->reveal()]
        );

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }
}
