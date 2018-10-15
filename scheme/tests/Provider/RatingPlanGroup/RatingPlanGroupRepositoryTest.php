<?php

namespace Tests\Provider\RatingPlanGroup;

use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;

class RatingPlanGroupRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_gets_all_rows_through_a_generator()
    {
        /** @var RatingPlanGroupRepository $ratingPlanGroupRepository */
        $ratingPlanGroupRepository = $this->em
            ->getRepository(RatingPlanGroup::class);

        $ratingPlanGroupGenerator = $ratingPlanGroupRepository
            ->getAllRatesByRatingPlanId(1);

        $this->assertInstanceOf(
            \Generator::class,
            $ratingPlanGroupGenerator
        );

        foreach ($ratingPlanGroupGenerator as $iteration) {
            $this->assertInternalType(
                'array',
                $iteration
            );

            break;
        }
    }
}