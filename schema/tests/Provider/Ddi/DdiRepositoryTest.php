<?php

namespace Tests\Provider\Ddi;

use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

class DdiRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_ddi_e164();
    }

    public function its_instantiable()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $this->assertInstanceOf(
            DdiRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_ddi_e164()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $ddi = $repository->findOneByDdiE164('+34123');

        $this->assertInstanceOf(
            Ddi::class,
            $ddi
        );
    }
}
