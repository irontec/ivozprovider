<?php

namespace Tests\Provider\FixedCost;

use Ivoz\Provider\Domain\Model\FixedCost\FixedCostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCost;

class FixedCostRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var FixedCostRepository $repository */
        $repository = $this
            ->em
            ->getRepository(FixedCost::class);

        $this->assertInstanceOf(
            FixedCostRepository::class,
            $repository
        );
    }
}
