<?php

namespace Tests\Provider\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist;

class ConditionalRoutesConditionsRelMatchlistRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConditionalRoutesConditionsRelMatchlistRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoutesConditionsRelMatchlist::class);

        $this->assertInstanceOf(
            ConditionalRoutesConditionsRelMatchlistRepository::class,
            $repository
        );
    }
}