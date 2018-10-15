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
}