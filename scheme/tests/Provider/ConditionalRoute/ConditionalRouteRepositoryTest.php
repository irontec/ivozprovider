<?php

namespace Tests\Provider\ConditionalRoute;

use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;

class ConditionalRouteRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var ConditionalRouteRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ConditionalRoute::class);

        $this->assertInstanceOf(
            ConditionalRouteRepository::class,
            $repository
        );
    }
}