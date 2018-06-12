<?php

namespace spec\Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Extension\UpdateByUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByUserSpec extends ObjectBehavior
{
    use HelperTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUser::class);
    }

    function it_does_nothing_if_extensionId_has_not_change(
        UserInterface $entity
    ) {
        $entity
            ->hasChanged('id')
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->hasChanged('extensionId')
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->getExtension()
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }

    function it_updates_extension_when_user_extension_has_changed(
        UserInterface $entity,
        ExtensionInterface $extension
    ) {
        $entity
            ->hasChanged('id')
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->hasChanged('extensionId')
            ->willReturn(true)
            ->shouldBeCalled();

        $entity
            ->getExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $this->fluentSetterProphecy(
            $extension,
            [
                'setRouteType' => 'user',
                'setUser' => $entity
            ]
        );

        $this->execute($entity, false);
    }


    function it_does_nothing_when_extensionid_is_empty(
        UserInterface $entity
    ) {
        $entity
            ->hasChanged('id')
            ->willReturn(false)
            ->shouldBeCalled();

        $entity
            ->hasChanged('extensionId')
            ->willReturn(true)
            ->shouldBeCalled();

        $entity
            ->getExtension()
            ->willReturn(null)
            ->shouldBeCalled();

        $this->execute($entity, false);
    }

    function it_cleans_up_extension_on_remove(
        UserInterface $entity,
        ExtensionInterface $extension
    ) {
        $entity
            ->hasChanged('id')
            ->willReturn(true)
            ->shouldBeCalled();

        $entity
            ->getId()
            ->willReturn(null)
            ->shouldBeCalled();

        $entity
            ->getExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $extension
            ->setRouteType(null)
            ->willReturn($extension)
            ->shouldBeCalled();

        $extension
            ->setUser(null)
            ->willReturn($extension)
            ->shouldBeCalled();

        $this->execute($entity, false);
    }
}
