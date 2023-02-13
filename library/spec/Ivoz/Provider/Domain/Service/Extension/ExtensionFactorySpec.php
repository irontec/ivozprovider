<?php

namespace spec\Ivoz\Provider\Domain\Service\Extension;

use Doctrine\ORM\UnitOfWork;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Service\Extension\ExtensionFactory;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ExtensionFactorySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $extensionRepository;
    protected $entityTools;

    public function let(
        ExtensionRepository $extensionRepository,
        EntityTools $entityTools
    ) {
        $this->extensionRepository = $extensionRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->extensionRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ExtensionFactory::class);
    }

    function it_searches_if_extension_exists()
    {
        $this->prepareExecution();

        $extension = $this->getInstance(
            Extension::class
        );

        $this
            ->extensionRepository
            ->findCompanyExtension(
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($extension);

        $this->fromMassProvisioningCsv(
            ...$this->getInputArgs()
        );
    }

    function it_creates_new_extension_if_necessary()
    {
        $this->prepareExecution();

        $extension = $this->getInstance(
            Extension::class
        );

        $this
            ->extensionRepository
            ->findCompanyExtension(
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn(null);

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(ExtensionDto::class),
                null
            )
            ->shouldBeCalled()
            ->willReturn(
                $extension
            );

        $this
            ->fromMassProvisioningCsv(
                ...$this->getInputArgs()
            )
            ->shouldReturn(
                $extension
            );
    }

    private function getInputArgs(): array
    {
        return [
            1,
            202,
            $this->getInstance(User::class)
        ];
    }

    private function prepareExecution()
    {
        $this
            ->entityTools
            ->entityToDto(
                Argument::type(ExtensionInterface::class)
            )
            ->willReturn(new ExtensionDto());

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(ExtensionDto::class),
                Argument::any()
            )
            ->willReturn(
                $this->getInstance(
                    Extension::class
                )
            );
    }
}
