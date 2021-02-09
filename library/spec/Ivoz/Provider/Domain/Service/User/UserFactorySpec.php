<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
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
        $user = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldNotBeCalled();

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

        $user = $this->getTestDouble(
            UserInterface::class
        );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class)
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
