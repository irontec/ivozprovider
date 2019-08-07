<?php

namespace Tests\Provider\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLock;

class ConditionalRoutesConditionsRelRouteLockRepositoryTest extends KernelTestCase
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
        /** @var ConditionalRoutesConditionsRelRouteLockRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoutesConditionsRelRouteLock::class);

        $this->assertInstanceOf(
            ConditionalRoutesConditionsRelRouteLockRepository::class,
            $repository
        );
    }
}
