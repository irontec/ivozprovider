<?php

namespace Tests\Cgr\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileRepository;

class TpRatingProfileRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
    }

    public function its_instantiable()
    {
        /** @var TpRatingProfileRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpRatingProfile::class);

        $this->assertInstanceOf(
            TpRatingProfileRepository::class,
            $repository
        );
    }
}
