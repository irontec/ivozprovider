<?php

namespace Tests\Provider\BalanceMovement;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;

class BalanceMovementRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var BalanceMovementRepository $repository */
        $repository = $this
            ->em
            ->getRepository(BalanceMovement::class);

        $this->assertInstanceOf(
            BalanceMovementRepository::class,
            $repository
        );
    }
}