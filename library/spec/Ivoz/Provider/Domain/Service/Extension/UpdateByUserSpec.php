<?php

namespace spec\Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Extension\UpdateByUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByUserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUser::class);
    }

    function it_does_nothing_if_extensionId_has_not_changed(
        UserInterface $entity,
        ExtensionInterface $extension
    ) {
        $entity
            ->getExtension()
            ->willReturn($extension)
            ->shouldBecalled();

        $entity
            ->hasChanged('id')
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->hasChanged('extensionId')
            ->willReturn(false)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_updates_extension_when_user_extension_has_changed(
        UserInterface $user,
        ExtensionInterface $extension,
        ExtensionDto $extensionDto
    ) {
        $user
            ->hasChanged('id')
            ->willReturn(false)
            ->shouldBeCalled();

        $user
            ->hasChanged('extensionId')
            ->willReturn(true)
            ->shouldBeCalled();

        $user
            ->getExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($extension)
            ->willReturn($extensionDto)
            ->shouldBeCalled();

        $user
            ->getId()
            ->willReturn(1001);

        $this->fluentSetterProphecy(
            $extensionDto,
            [
                'setRouteType' => 'user',
                'setUserId' => 1001
            ]
        );

        $this
            ->entityTools
            ->persistDto(
                $extensionDto,
                $extension,
                false
            )->shouldBeCalled();

        $this->execute($user);
    }

    function it_does_nothing_when_extensionid_is_empty(
        UserInterface $user
    ) {
        $user
            ->getExtension()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($user);
    }

    function it_cleans_up_extension_on_remove(
        UserInterface $user,
        ExtensionInterface $extension,
        ExtensionDto $extensionDto
    ) {
        $user
            ->getExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($extension)
            ->willReturn($extensionDto);

        $user
            ->hasChanged('id')
            ->willReturn(true)
            ->shouldBeCalled();

        $user
            ->getId()
            ->willReturn(null)
            ->shouldBeCalled();

        $extensionDto
            ->setRouteType(null)
            ->willReturn($extensionDto)
            ->shouldBeCalled();

        $extensionDto
            ->setUserId(null)
            ->willReturn($extensionDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $extensionDto,
                $extension,
                false
            )->shouldBeCalled();

        $this->execute($user);
    }
}
