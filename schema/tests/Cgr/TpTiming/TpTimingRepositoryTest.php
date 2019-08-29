<?php

namespace Tests\Cgr\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingRepository;

class TpTimingRepositoryTest extends KernelTestCase
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
        /** @var TpTimingRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpTiming::class);

        $this->assertInstanceOf(
            TpTimingRepository::class,
            $repository
        );
    }
}
