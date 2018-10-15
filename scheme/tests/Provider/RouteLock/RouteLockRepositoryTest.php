<?php

namespace Tests\Provider\RouteLock;

use Ivoz\Provider\Domain\Model\RouteLock\RouteLockRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLock;

class RouteLockRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var RouteLockRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RouteLock::class);

        $this->assertInstanceOf(
            RouteLockRepository::class,
            $repository
        );
    }
}