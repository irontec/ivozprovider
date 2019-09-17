<?php

namespace Tests\Cgr\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpRate\TpRate;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateRepository;

class TpRateRepositoryTest extends KernelTestCase
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
        /** @var TpRateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpRate::class);

        $this->assertInstanceOf(
            TpRateRepository::class,
            $repository
        );
    }
}
