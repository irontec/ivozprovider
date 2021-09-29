<?php

namespace Tests\Provider\RatingProfile;

use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;

class RatingProfileRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_gets_rating_plan_group_ids_by_company();
    }

    public function it_gets_rating_plan_group_ids_by_company()
    {
        /** @var RatingProfileRepository $ratingProfileRepository */
        $ratingProfileRepository = $this->em
            ->getRepository(RatingProfile::class);

        $ratingPlanGroupIds = $ratingProfileRepository
            ->getRatingPlanGroupIdsByCompany(1);

        $this->assertIsArray(
            $ratingPlanGroupIds
        );

        $this->assertIsInt(
            $ratingPlanGroupIds[0]
        );
    }
}
