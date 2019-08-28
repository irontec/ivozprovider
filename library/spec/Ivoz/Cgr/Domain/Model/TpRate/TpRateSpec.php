<?php

namespace spec\Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRate;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class TpRateSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var TpRateDto
     */
    protected $dto;

    protected $destinationRate;

    function let()
    {

        $utc = new \DateTimeZone('UTC');

        $this->dto = $dto = new TpRateDto();
        $dto
            ->setTpid('b1')
            ->setTag('b1rt1')
            ->setConnectFee(0.1000)
            ->setRateCost(0.2000)
            ->setRateUnit('60s')
            ->setRateIncrement('1s')
            ->setGroupIntervalStart('0s')
            ->setCreatedAt(
                new \DateTime(
                    '2019-01-22 12:51:32',
                    new \DateTimeZone('UTC')
                )
            );

        $this->destinationRate = $this->getTestDouble(
            DestinationRate::class,
            true
        );

        $this->hydrate(
            $dto,
            ['destinationRate' => $this->destinationRate->reveal()]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TpRate::class);
    }

    function it_ensures_format_on_rateIncrement_set()
    {
        $dto = clone $this->dto;
        $dto
            ->setRateIncrement(9);

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getRateIncrement()
            ->shouldReturn('9s');
    }

    function it_ensures_format_on_groupIntervalStart_set()
    {
        $dto = clone $this->dto;
        $dto
            ->setGroupIntervalStart(4);

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getGroupIntervalStart()
            ->shouldReturn('4s');
    }
}
