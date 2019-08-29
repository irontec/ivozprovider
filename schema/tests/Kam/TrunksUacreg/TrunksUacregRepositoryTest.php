<?php

namespace Tests\Provider\TrunksUacreg;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregRepository;

class TrunksUacregRepositoryTest extends KernelTestCase
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
        /** @var TrunksUacregRepository $repository */
        $repository = $this
            ->em
            ->getRepository(TrunksUacreg::class);

        $this->assertInstanceOf(
            TrunksUacregRepository::class,
            $repository
        );
    }
}
