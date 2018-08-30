<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Service\TpRatingPlan\InheritRatingPlanTag;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use PhpSpec\ObjectBehavior;

class InheritRatingPlanTagSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    public function let(
        EntityTools $entityTools,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->entityTools = $entityTools;
        $this->entityUpdater = $entityUpdater;
        $this->beConstructedWith($entityTools, $entityUpdater);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(InheritRatingPlanTag::class);
    }

    function it_updates_tags(
        TpRatingPlanInterface $tpRatingPlan,
        TpRatingPlanDto $tpRatingPlanDto,
        RatingPlanInterface $ratingPlan,
        DestinationRateGroupInterface $destinationRateGroup
    ) {
        $this
            ->entityTools
            ->entityToDto($tpRatingPlan)
            ->willReturn($tpRatingPlanDto);

        $tpRatingPlan
            ->getRatingPlan()
            ->willReturn($ratingPlan);

        $ratingPlan
            ->getCgrTag()
            ->willReturn('RatingPlanTag');

        $tpRatingPlanDto
            ->setTag('RatingPlanTag')
            ->shouldBeCalled();

        $tpRatingPlan
            ->getDestinationRateGroup()
            ->willReturn($destinationRateGroup);

        $destinationRateGroup
            ->getCgrTag()
            ->willReturn('CgrTag');

        $tpRatingPlanDto
            ->setDestratesTag('CgrTag')
            ->shouldBeCalled();

        $this->entityUpdater
            ->execute(
                $tpRatingPlan,
                $tpRatingPlanDto
            )->shouldBeCalled();

        $this->execute($tpRatingPlan, true);
    }
}
