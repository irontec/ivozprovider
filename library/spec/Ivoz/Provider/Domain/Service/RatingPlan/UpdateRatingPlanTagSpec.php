<?php

namespace spec\Ivoz\Provider\Domain\Service\RatingPlan;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\UpdateRatingPlanTag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateRatingPlanTagSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateRatingPlanTag::class);
    }

    function it_sets_tag(
        RatingPlanInterface $ratingPlan,
        RatingPlanDto $ratingPlanDto,
        BrandInterface $brand
    ) {
        $this
            ->entityTools
            ->entityToDto($ratingPlan)
            ->willReturn($ratingPlanDto);

        $ratingPlan
            ->getBrand()
            ->willReturn($brand);

        $brand
            ->getId()
            ->willReturn(11);

        $ratingPlan
            ->getId()
            ->willReturn(22);

        $ratingPlanDto
            ->setTag('b11rp22')
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $ratingPlanDto,
                $ratingPlan,
                false
            )->shouldBeCalled();

        $this->execute($ratingPlan);
    }
}
