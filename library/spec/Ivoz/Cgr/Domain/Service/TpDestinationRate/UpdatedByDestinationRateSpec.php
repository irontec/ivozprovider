<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Service\TpDestinationRate\UpdatedByDestinationRate;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdatedByDestinationRateSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $destinationRate;
    protected $destinationRateDto;
    protected $destinationRateGroup;
    protected $brand;
    protected $tpDestinationRate;
    protected $tpDestinationRateDto;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class,
            true
        );

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    protected function prepareExecution()
    {
        $this->destinationRate = $this->getTestDouble(
            DestinationRateInterface::class,
            true
        );

        $this->destinationRateDto = $this->getTestDouble(
            DestinationRateDto::class,
            true
        );

        $this->destinationRateGroup = $this->getTestDouble(
            DestinationRateGroupInterface::class,
            true
        );
        $this->getterProphecy(
            $this->destinationRateGroup,
            [
                'getRoundingMethod' => TpDestinationRateInterface::ROUNDINGMETHOD_UP
            ],
            false
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $this->tpDestinationRate = $this->getTestDouble(
            TpDestinationRateInterface::class,
            true
        );

        $this->tpDestinationRateDto = $this->getTestDouble(
            TpDestinationRateDto::class,
            true
        );

        $this->getterProphecy(
            $this->destinationRate,
            [
                'getDestinationRateGroup' => $this->destinationRateGroup,
                'getTpDestinationRate' => $this->tpDestinationRate,
                'getId' => 1,
                'getCgrTag' => 'b1dr1',
                'getCgrDestinationsTag' => 'b1dst1',
                'getCgrRatesTag' => 'b1rt1'
            ],
            false
        );

        $this->getterProphecy(
            $this->destinationRateGroup,
            [
                'getBrand' => $this->brand
            ],
            false
        );

        $this->getterProphecy(
            $this->brand,
            [
                'getCgrTenant' => 'b1'
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->tpDestinationRateDto,
            [
                'setTpid' => Argument::any(),
                'setDestinationRateId' => Argument::any(),
                'setTag' => Argument::any(),
                'setDestinationsTag' => Argument::any(),
                'setRatesTag' => Argument::any()
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto(
                $this->destinationRate
            )
            ->willReturn(
                $this->destinationRateDto
            );

        $this
            ->entityTools
            ->entityToDto(
                $this->tpDestinationRate
            )
            ->willReturn(
                $this->tpDestinationRateDto
            );

        $this
            ->entityTools
            ->persistDto(
                $this->tpDestinationRateDto,
                $this->tpDestinationRate,
                true
            )
            ->willReturn($this->tpDestinationRate);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdatedByDestinationRate::class);
    }

    function it_updates_tpDestinationRate()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                $this->tpDestinationRateDto,
                $this->tpDestinationRate,
                true
            )
            ->shouldBeCalled();

        $this->execute(
            $this->destinationRate
        );
    }

    function it_updates_destinationRate()
    {
        $this->prepareExecution();

        $this
            ->destinationRateDto
            ->setTpDestinationRate(
                $this->tpDestinationRateDto
            )
            ->willReturn($this->destinationRateDto)
            ->shouldBeCalled();

        $this->entityTools
            ->persistDto(
                $this->destinationRateDto,
                $this->destinationRate
            )
            ->shouldBeCalled();

        $this->execute(
            $this->destinationRate
        );
    }
}
