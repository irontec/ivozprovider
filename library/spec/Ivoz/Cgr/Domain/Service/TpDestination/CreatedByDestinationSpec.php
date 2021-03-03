<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Service\TpDestination\CreatedByDestination;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreatedByDestinationSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;

    protected $destination;
    protected $destinationDto;
    protected $brand;
    protected $tpDestination;
    protected $tpDestinationDto;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    protected function prepareExecution()
    {
        $this->destination = $destination = $this->getTestDouble(
            DestinationInterface::class,
            true
        );

        $this->destinationDto = $destinationDto = $this->getTestDouble(
            DestinationDto::class,
            true
        );

        $this->brand = $brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $this->getterProphecy(
            $this->brand,
            [
                'getId' => 1
            ],
            false
        );

        $this->tpDestination = $tpDestination = $this->getTestDouble(
            TpDestinationInterface::class,
            true
        );

        $this->tpDestinationDto = $tpDestinationDto = $this->getTestDouble(
            TpDestinationDto::class,
            true
        );

        $this->fluentSetterProphecy(
            $this->tpDestinationDto,
            [
                'setTpid' => Argument::any(),
                'setPrefix' => Argument::any(),
                'setDestinationId' => Argument::any(),
                'setTag' => Argument::any(),
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto($tpDestination)
            ->willReturn($tpDestinationDto);

        $this
            ->entityTools
            ->entityToDto($destination)
            ->willReturn($destinationDto);

        $this
            ->entityTools
            ->persistDto(
                $tpDestinationDto,
                $tpDestination,
                true
            )
            ->willReturn($tpDestination);

        $this->getterProphecy(
            $destination,
            [
                'isNew' => true,
                'getBrand' => $brand,
                'getTpDestination' => $tpDestination,
                'getPrefix' => '+34',
                'getId' => 1,
                'getCgrTag' => 'b1dst1'
            ],
            false
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedByDestination::class);
    }

    function it_does_nothing_on_updated_destinations()
    {
        $this->prepareExecution();

        $this
            ->destination
            ->isNew()
            ->willReturn(false)
            ->shouldBeCalled();

        $this
            ->destination
            ->getBrand()
            ->shouldNotBeCalled();

        $this->execute(
            $this->destination
        );
    }

    function it_persists_tp_destination()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TpDestinationDto::class),
                Argument::any(),
                true
            )
            ->shouldBeCalled();

        $this->execute(
            $this->destination
        );
    }

    function it_updates_destination()
    {
        $this->prepareExecution();

        $this
            ->destinationDto
            ->setTpDestination(
                $this->tpDestinationDto
            )
            ->willReturn($this->destinationDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(DestinationDto::class),
                Argument::type(DestinationInterface::class)
            )
            ->shouldBeCalled();

        $this->execute(
            $this->destination
        );
    }
}
