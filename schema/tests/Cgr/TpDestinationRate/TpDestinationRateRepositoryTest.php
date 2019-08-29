<?php

namespace Tests\Cgr\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateRepository;

class TpDestinationRateRepositoryTest extends KernelTestCase
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
        /** @var TpDestinationRateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpDestinationRate::class);

        $this->assertInstanceOf(
            TpDestinationRateRepository::class,
            $repository
        );
    }
}
