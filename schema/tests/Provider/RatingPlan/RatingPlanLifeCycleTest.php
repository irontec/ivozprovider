<?php

namespace Tests\Provider\RatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RatingPlanLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return RatingPlanDto
     */
    protected function createDto()
    {
        $ratingPlanDto = new RatingPlanDto();
        $ratingPlanDto
            ->setTimeIn(new \DateTime('2020-01-01 10:10:10'))
            ->setWeight(9)
            ->setTimingType(RatingPlanInterface::TIMINGTYPE_CUSTOM)
            ->setRatingPlanGroupId(2)
            ->setDestinationRateGroupId(1);

        return $ratingPlanDto;
    }

    /**
     * @return RatingPlan
     */
    protected function addRatingPlan()
    {
        $ratingPlanDto = $this->createDto();

        /** @var RatingPlan $ratingPlan */
        $ratingPlan = $this->entityTools
            ->persistDto($ratingPlanDto, null, true);

        return $ratingPlan;
    }

    protected function updateRatingPlan($id = 1)
    {
        $ratingPlanRepository = $this->em
            ->getRepository(RatingPlan::class);

        $ratingPlan = $ratingPlanRepository->find($id);

        /** @var RatingPlanDto $ratingPlanDto */
        $ratingPlanDto = $this->entityTools->entityToDto($ratingPlan);

        $ratingPlanDto
            ->setTimeIn(new \DateTime('2020-11-11 11:11:11'))
            ->setTimingType(RatingPlanInterface::TIMINGTYPE_CUSTOM)
            ->setDestinationRateGroupId(2);

        return $this
            ->entityTools
            ->persistDto($ratingPlanDto, $ratingPlan, true);
    }

    protected function removeRatingPlan()
    {
        $ratingPlanRepository = $this->em
            ->getRepository(RatingPlan::class);

        $ratingPlan = $ratingPlanRepository->find(1);

        $this
            ->entityTools
            ->remove($ratingPlan);
    }

    /**
     * @test
     */
    public function it_persists_ratingPlans()
    {
        $ratingPlan = $this->em
            ->getRepository(RatingPlan::class);
        $fixtureRatingPlans = $ratingPlan->findAll();

        $this->addRatingPlan();

        $brands = $ratingPlan->findAll();
        $this->assertCount(count($fixtureRatingPlans) + 1, $brands);


        //////////////////////////////
        ///
        //////////////////////////////

        $this->it_triggers_lifecycle_services();
        $this->it_creates_tp_rating_plan();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            RatingPlan::class,
            TpRatingPlan::class,
            TpTiming::class,
        ]);
    }

    protected function it_creates_tp_rating_plan()
    {
        $changelogEntries = $this->getChangelogByClass(
            TpRatingPlan::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertSubset(
            $changelog,
            [
                'tpid' => 'b1',
                'tag' => 'b1rp2',
                'destrates_tag' => 'b1dr1',
                'timing_tag' => 'b1tm2',
                'weight' => 9.0,
                'ratingPlanId' => 2,
                'id' => 1,
            ],
            [
                'created_at'
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRatingPlan();
        $this->assetChangedEntities([
            RatingPlan::class,
            TpRatingPlan::class,
            TpTiming::class,
        ]);
    }

    /**
     * @test
     */
    public function it_updates_tp_rating_plan()
    {
        $rp = $this->addRatingPlan();
        $this->resetChangelog();

        $this->updateRatingPlan(
            $rp->getId()
        );

        $changelogEntries = $this->getChangelogByClass(
            TpRatingPlan::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'destrates_tag' => 'b1dr2',
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRatingPlan();
        $this->assetChangedEntities([
            RatingPlan::class,
        ]);
    }
}
