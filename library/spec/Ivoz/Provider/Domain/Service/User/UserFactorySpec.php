<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UserFactorySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $userRepository;
    protected $entityTools;

    public function let(
        UserRepository $userRepository,
        EntityTools $entityTools
    ) {
        $this->userRepository = $userRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->userRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UserFactory::class);
    }

    function it_search_for_existing_user()
    {
        $user = $this->getInstance(
            User::class,
            ['active' => false]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn();

        $this
            ->userRepository
            ->findOneByEmail(
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn(
                new UserDto()
            );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class),
                Argument::type(User::class)
            )
            ->willReturn(
                $user
            );

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                'email@domain.net'
            )
            ->shouldReturn($user);
    }

    function it_creates_user_if_not_exists()
    {
        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn(null);

        $this
            ->userRepository
            ->findOneByEmail(
                Argument::any()
            )
            ->willReturn();

        $user = $this->getInstance(
            User::class,
            ['active' => false]
        );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class),
                null
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                'email@domain.net'
            )
            ->shouldReturn($user);
    }
}
