<?php

namespace Tests\Provider\RatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\DoctrineEventSubscriber;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto;

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
            ->setTimingType('custom')
            ->setRatingPlanGroupId(1)
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

    protected function updateRatingPlan()
    {
        $ratingPlanRepository = $this->em
            ->getRepository(RatingPlan::class);

        $ratingPlan = $ratingPlanRepository->find(1);

        /** @var RatingPlanDto $ratingPlanDto */
        $ratingPlanDto = $this->entityTools->entityToDto($ratingPlan);

        $ratingPlanDto
            ->setTimeIn(new \DateTime('2020-11-11 11:11:11'))
            ->setTimingType('custom');

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
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addRatingPlan();
        $this->assetChangedEntities([
            RatingPlan::class,
            TpRatingPlan::class,
            TpTiming::class,
        ]);
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
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRatingPlan();
        $this->assetChangedEntities([
            RatingPlan::class,
        ]);
    }

    ////////////////////////////////////////
    ///
    ////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_ps_endpoint()
    {
        $this->addRatingPlan();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TpRatingPlan::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [DoctrineEventSubscriber::UnaccesibleChangeset]
        );
    }
}
