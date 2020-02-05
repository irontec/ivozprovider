<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Service\TpRate\UpdatedByDestinationRate;
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
    protected $tpRate;
    protected $tpRateDto;

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

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $this->tpRate = $this->getTestDouble(
            TpRateInterface::class,
            true
        );

        $this->tpRateDto = $this->getTestDouble(
            TpRateDto::class,
            true
        );

        $this->getterProphecy(
            $this->destinationRate,
            [
                'getDestinationRateGroup' => $this->destinationRateGroup,
                'getTpRate' => $this->tpRate,
                'getId' => 1,
                'getCgrRatesTag' => 'b1rt1',
                'getConnectFee' => 0.1,
                'getCost' => 0.2,
                'getRateIncrement' => '1s',
                'getGroupIntervalStart' => '0s'
            ],
            false
        );

        $this->getterProphecy(
            $this->destinationRateGroup,
            [
                'getBrand' => $this->brand,
            ],
            false
        );

        $this->getterProphecy(
            $this->brand,
            [
                'getCgrTenant' => 'b1',
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->tpRateDto,
            [
                'setTpid' => Argument::any(),
                'setDestinationRateId' => Argument::any(),
                'setTag' => Argument::any(),
                'setConnectFee' => Argument::any(),
                'setRateCost' => Argument::any(),
                'setRateIncrement' => Argument::any(),
                'setGroupIntervalStart' => Argument::any(),
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto($this->tpRate)
            ->willReturn($this->tpRateDto);

        $this
            ->entityTools
            ->entityToDto($this->destinationRate)
            ->willReturn($this->destinationRateDto);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdatedByDestinationRate::class);
    }

    function it_updates_tpRate()
    {
        $this
            ->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                $this->tpRateDto,
                $this->tpRate,
                true
            )
            ->shouldBeCalled();

        $this->execute($this->destinationRate);
    }

    function it_updates_destinationRate()
    {
        $this
            ->prepareExecution();

        $this->destinationRateDto
            ->setTpRate(
                $this->tpRateDto
            )
        ->shouldbeCalled();

        $this
            ->entityTools
            ->persistDto(
                $this->destinationRateDto,
                $this->destinationRate
            )
            ->shouldBeCalled();

        $this->execute($this->destinationRate);
    }
}
