<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\UnsetBossAssistant;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnsetBossAssistantSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function let(
        EntityPersisterInterface $entityPersister,
        UserRepository $userRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->userRepository = $userRepository;

        $this->beConstructedWith(
            $entityPersister,
            $userRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UnsetBossAssistant::class);
    }

    function it_does_nothing_unless_isNotNew(
        UserInterface $entity
    ) {
        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity, true);
    }

    function it_does_nothing_unless_isBoss(
        UserInterface $entity
    ) {
        $entity
            ->getIsBoss()
            ->willReturn(false);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }

    function it_does_nothing_unless_isBossHasChanged(
        UserInterface $entity
    ) {
        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(false);

        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }

    function it_does_nothing_unless_it_has_an_assistant(
        UserInterface $entity
    ) {
        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $entity
            ->getId()
            ->willReturn(1);

        $this
            ->userRepository
            ->findBy(['bossAssistant' => 1])
            ->willReturn([])
            ->shouldBeCalled();
        $this
            ->entityPersister
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }

    function it_resets_old_assistant(
        UserInterface $entity,
        UserInterface $boss
    ) {
        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $entity
            ->getId()
            ->willReturn(1);

        $this
            ->userRepository
            ->findBy(['bossAssistant' => 1])
            ->willReturn([$boss])
            ->shouldBeCalled();

        $bossDto = new UserDto();
        $bossDto->setBossAssistantId(1);

        $boss
            ->toDto()
            ->willReturn($bossDto)
            ->shouldBeCalled();

        $assistantValidatorCallback = function ($assistantDTO) {
            return $assistantDTO->getBossAssistantId() === null;
        };

        $this
            ->entityPersister
            ->persistDto(
                Argument::that($assistantValidatorCallback),
                $boss
            )
            ->shouldBeCalled();

        $this->execute($entity, false);
    }
}
