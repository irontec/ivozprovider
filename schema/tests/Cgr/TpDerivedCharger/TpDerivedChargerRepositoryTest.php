<?php

namespace Tests\Cgr\TpDerivedCharger;

use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedChargerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedCharger;
use Ivoz\Cgr\Domain\Model\TpDerivedCharger\TpDerivedChargerRepository;

class TpDerivedChargerRepositoryTest extends KernelTestCase
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
        /** @var TpDerivedChargerRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TpDerivedCharger::class);

        $this->assertInstanceOf(
            TpDerivedChargerRepository::class,
            $repository
        );
    }
}
