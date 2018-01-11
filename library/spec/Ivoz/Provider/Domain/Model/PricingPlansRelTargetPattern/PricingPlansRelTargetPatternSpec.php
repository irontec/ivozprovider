<?php

namespace spec\Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface;
use Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern\PricingPlansRelTargetPattern;
use Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern\PricingPlansRelTargetPatternDto;
use Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class PricingPlansRelTargetPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    function let(
        PricingPlanInterface $pricingPlan,
        TargetPatternInterface $targetPattern,
        BrandInterface $brand
    ) {
        $dto = new PricingPlansRelTargetPatternDto();
        $dto->setConnectionCharge(2.10)
            ->setPeriodTime(2)
            ->setPerPeriodCharge(3);

        $this->hydrate(
            $dto,
            [
                'pricingPlan' => $pricingPlan->getWrappedObject(),
                'targetPattern' => $targetPattern->getWrappedObject(),
                'brand' => $brand->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PricingPlansRelTargetPattern::class);
    }

    function it_throws_exception_on_invalid_connectionCharge()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', ['a.988']);

        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', ['123456,3']);

        $this
            ->shouldThrow('\Exception')
            ->during('setConnectionCharge', [1234567.3]);
    }

    function it_accepts_valid_connectionCharge()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setConnectionCharge', [9.11]);
    }

    function it_throws_exception_on_invalid_periodCharge()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', ['a.988']);

        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', ['123456,3']);

        $this
            ->shouldThrow('\Exception')
            ->during('setPerPeriodCharge', [1234567.3]);
    }

    function it_accepts_valid_periodCharge()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPerPeriodCharge', [9.11]);
    }
}
