<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Application\Service\EntityTools;
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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function let(
        EntityTools $entityTools,
        UserRepository $userRepository
    ) {
        $this->entityTools = $entityTools;
        $this->userRepository = $userRepository;

        $this->beConstructedWith(
            $entityTools,
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
            ->isNew()
            ->willReturn(true);

        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $this
            ->entityTools
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();


        $this->execute($entity);
    }

    function it_does_nothing_unless_isBoss(
        UserInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(false);

        $entity
            ->getIsBoss()
            ->willReturn(false);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(true);

        $this
            ->entityTools
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_does_nothing_unless_isBossHasChanged(
        UserInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(false);

        $entity
            ->getIsBoss()
            ->willReturn(true);

        $entity
            ->hasChanged('isBoss')
            ->willReturn(false);

        $this
            ->entityTools
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_does_nothing_unless_it_has_an_assistant(
        UserInterface $entity
    ) {
        $entity
            ->isNew()
            ->willReturn(false);

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
            ->findByBossAssistantId(1)
            ->willReturn([])
            ->shouldBeCalled();
        $this
            ->entityTools
            ->persistDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($entity);
    }

    function it_resets_old_assistant(
        UserInterface $entity,
        UserInterface $boss
    ) {
        $entity
            ->isNew()
            ->willReturn(false);

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
            ->findByBossAssistantId(1)
            ->willReturn([$boss])
            ->shouldBeCalled();

        $bossDto = new UserDto();
        $bossDto->setBossAssistantId(1);

        $this
            ->entityTools
            ->entityToDto($boss)
            ->willReturn($bossDto)
            ->shouldBeCalled();

        $assistantValidatorCallback = function ($assistantDTO) {
            return $assistantDTO->getBossAssistantId() === null;
        };

        $this
            ->entityTools
            ->persistDto(
                Argument::that($assistantValidatorCallback),
                $boss
            )
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
