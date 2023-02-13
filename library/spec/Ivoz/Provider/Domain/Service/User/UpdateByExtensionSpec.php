<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\UpdateByExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByExtensionSpec extends ObjectBehavior
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        UserRepository $userRepository,
        EntityTools $entityTools
    ) {
        $this->userRepository = $userRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith($userRepository, $entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByExtension::class);
    }

    function it_does_nothing_when_userId_hasnt_changed(
        ExtensionInterface $entity
    ) {
        $entity
            ->hasChanged('userId')
            ->willReturn(false);

        $entity
            ->getUser()
            ->shouldNotBeCalled();

        $this->execute($entity);
    }


    function it_resets_previous_user_extension_if_number_has_changed(
        ExtensionInterface $extension,
        UserInterface $user,
        UserInterface $prevUser,
        UserDto $prevUserDto
    ) {
        $this->prepareExecution(
            $extension,
            $user
        );

        $user
            ->getId()
            ->willReturn(2);

        $extension
            ->getInitialValue('userId')
            ->willReturn(1);

        $this
            ->userRepository
            ->find(1)
            ->willReturn($prevUser)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(
                $prevUser
            )
            ->willReturn(
                $prevUserDto
            );

        $prevUserDto
            ->setExtension(null)
            ->shouldBeCalled()
            ->willReturn($prevUserDto);

        $prevUserDto
            ->getExtensionId()
            ->willReturn(1)
            ->shouldBeCalled();

        $this->entityTools
            ->persistDto(
                $prevUserDto,
                $prevUser,
                false
            )
            ->shouldBeCalled();

        $this->execute($extension);
    }

    function it_does_not_set_user_extension_if_route_type_is_not_user(
        ExtensionInterface $extension,
        UserInterface $user
    ) {
        $this->prepareExecution(
            $extension,
            $user
        );

        $extension
            ->getRouteType()
            ->willReturn(ExtensionInterface::ROUTETYPE_NUMBER);

        $user
            ->getExtension()
            ->shouldNotbeCalled();

        $this->execute(
            $extension
        );
    }

    function it_does_not_set_user_extension_if_it_has_one(
        ExtensionInterface $extension,
        UserInterface $user
    ) {
        $this->prepareExecution(
            $extension,
            $user
        );

        $extension
            ->getRouteType()
            ->willReturn(ExtensionInterface::ROUTETYPE_USER);

        $user
            ->getExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($user)
            ->shouldNotBeCalled();

        $this->execute(
            $extension
        );
    }

    function it_sets_user_extension_if_empty(
        ExtensionInterface $extension,
        UserInterface $user,
        UserDto $userDto
    ) {
        $this->prepareExecution(
            $extension,
            $user
        );

        $extension
            ->getRouteType()
            ->willReturn(ExtensionInterface::ROUTETYPE_USER);

        $user
            ->getExtension()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($user)
            ->willReturn($userDto)
            ->shouldBeCalled();

        $extensionDto = new ExtensionDto();
        $this
            ->entityTools
            ->entityToDto(
                $extension
            )
            ->willReturn(
                $extensionDto
            )
            ->shouldBeCalled();

        $userDto
            ->setExtension($extensionDto)
            ->shouldBeCalled()
            ->willReturn($userDto);

        $this
            ->entityTools
            ->persistDto(
                $userDto,
                $user,
                false
            )
            ->shouldBeCalled();

        $this->execute($extension);
    }

    private function prepareExecution(ExtensionInterface $extension, UserInterface $user)
    {
        $extension
            ->hasChanged('userId')
            ->willReturn(true);

        $extension
            ->getUser()
            ->willReturn($user);

        $user
            ->getId()
            ->willReturn(1);

        $extension
            ->getInitialValue('userId')
            ->willReturn(1);

        $extension
            ->getRouteType()
            ->willReturn(null);

        $extension
            ->getId()
            ->willReturn(1);
    }
}
