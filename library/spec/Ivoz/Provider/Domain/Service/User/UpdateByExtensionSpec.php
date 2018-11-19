<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
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

    function it_resets_previous_user_extension(
        ExtensionInterface $entity,
        UserInterface $user,
        UserInterface $oldUser
    ) {
        $entity
            ->hasChanged('userId')
            ->willReturn(true);

        $entity
            ->getUser()
            ->willReturn($user);

        $user
            ->getId()
            ->willReturn(1);

        $entity
            ->getInitialValue('userId')
            ->willReturn(2);

        $this
            ->userRepository
            ->find(2)
            ->willReturn($oldUser)
            ->shouldBeCalled();

        $oldUser
            ->setExtension(null)
            ->shouldBeCalled();

        $entity
            ->getRouteType()
            ->willReturn(null);

        $this->execute($entity);
    }

    function it_sets_user_extension_if_empty(
        ExtensionInterface $entity,
        UserInterface $user
    ) {
        $entity
            ->hasChanged('userId')
            ->willReturn(true);

        $entity
            ->getUser()
            ->willReturn($user);

        $user
            ->getId()
            ->willReturn(1);

        $entity
            ->getInitialValue('userId')
            ->willReturn(null);

        $entity
            ->getRouteType()
            ->willReturn('user');

        $user
            ->getExtension()
            ->willReturn(null);

        $user
            ->setExtension($entity)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persist($user, false)
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
