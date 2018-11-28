<?php

namespace spec\Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Service\Ivr\UpdateByExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByExtensionSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var IvrRepository
     */
    protected $ivrRepository;

    public function let(
        EntityTools $entityTools,
        IvrRepository $ivrRepository
    ) {
        $this->entityTools = $entityTools;
        $this->ivrRepository = $ivrRepository;

        $this->beConstructedWith($entityTools, $ivrRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByExtension::class);
    }

    function it_cleans_up_no_input_extensions(
        ExtensionInterface $extension,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByExtension($extension)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $extension
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorExtension()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($ivr)
            ->willReturn($ivrDto);

        $ivrDto
            ->setNoInputRouteType(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $ivrDto
            ->setNoInputExtensionId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($extension);
    }



    function it_cleans_up_no_error_extensions(
        ExtensionInterface $extension,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByExtension($extension)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputExtension()
            ->willReturn(null)
            ->shouldBeCalled();

        $extension
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorExtension()
            ->willReturn($extension)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($ivr)
            ->willReturn($ivrDto);

        $ivrDto
            ->setErrorRouteType(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $ivrDto
            ->setErrorExtensionId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($extension);
    }
}
