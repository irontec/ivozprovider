<?php

namespace Tests\Provider\RatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;

class RatingProfileLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return RatingProfileDto
     */
    protected function createDto()
    {
        $ratingProfileDto = new RatingProfileDto();
        $ratingProfileDto
            ->setActivationTime(new \DateTime('2020-10-10 10:00:00'))
            ->setCompanyId(1)
            ->setCarrierId(1)
            ->setRatingPlanGroupId(1)
            ->setRoutingTagId(1)
            ->setTpRatingProfiles([]);

        return $ratingProfileDto;
    }

    /**
     * @return RatingProfile
     */
    protected function addRatingProfile()
    {
        $ratingProfileDto = $this->createDto();

        /** @var RatingProfile $ratingProfile */
        $ratingProfile = $this->entityTools
            ->persistDto($ratingProfileDto, null, true);

        return $ratingProfile;
    }

    protected function updateRatingProfile()
    {
        $ratingProfileRepository = $this->em
            ->getRepository(RatingProfile::class);

        $ratingProfile = $ratingProfileRepository->find(1);

        /** @var RatingProfileDto $ratingProfileDto */
        $ratingProfileDto = $this->entityTools->entityToDto($ratingProfile);

        $ratingProfileDto
            ->setActivationTime(new \DateTime('2020-12-12 10:00:00'));

        return $this
            ->entityTools
            ->persistDto($ratingProfileDto, $ratingProfile, true);
    }

    protected function removeRatingProfile()
    {
        $ratingProfileRepository = $this->em
            ->getRepository(RatingProfile::class);

        $ratingProfile = $ratingProfileRepository->find(1);

        $this
            ->entityTools
            ->remove($ratingProfile);
    }

    /**
     * @test
     */
    public function it_persists_ratingProfiles()
    {
        $ratingProfile = $this->em
            ->getRepository(RatingProfile::class);
        $fixtureRatingProfiles = $ratingProfile->findAll();
        $this->assertCount(2, $fixtureRatingProfiles);

        $this->addRatingProfile();

        $brands = $ratingProfile->findAll();
        $this->assertCount(3, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addRatingProfile();
        $this->assetChangedEntities([
            RatingProfile::class,
            TpRatingProfile::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRatingProfile();
        $this->assetChangedEntities([
            RatingProfile::class,
            TpRatingProfile::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRatingProfile();
        $this->assetChangedEntities([
            TpRatingProfile::class,
            RatingProfile::class,
        ]);
    }

    ////////////////////////////////////////
    ///
    ////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function it_updates_tp_rating_profile()
    {
        $this->addRatingProfile();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TpRatingProfile::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];
        $expectedSubset = [
            'tpid' => 'b1',
            'loadid' => 'DATABASE',
            'direction' => '*out',
            'tenant' => 'b1',
            'category' => 'call',
            'subject' => 'cr1rt1',
            'activation_time' => '2020-10-10 10:00:00',
            'rating_plan_tag' => 'b1rp1',
            'cdr_stat_queue_ids' => 'cr1',
            'ratingProfileId' => 3,
            'id' => 3
        ];
        $excludedSubsetKeys = [
            'created_at'
        ];

        $this->assertSubset(
            $changelog,
            $expectedSubset,
            $excludedSubsetKeys
        );
    }
}
