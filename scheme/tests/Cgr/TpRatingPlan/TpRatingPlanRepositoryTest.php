<?php

namespace Tests\Provider\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanRepository;

class TpRatingPlanRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var TpRatingPlanRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpRatingPlan::class);

        $this->assertInstanceOf(
            TpRatingPlanRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_finds_by_tag()
    {
        /** @var TpRatingPlanRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpRatingPlan::class);

        $result = $repository
            ->findOneByTag('tag');

        $this->assertInternalType(
            'null', // @todo TpRatingPlanInterface::class (No fixture yet)
            $result
        );
    }
}
