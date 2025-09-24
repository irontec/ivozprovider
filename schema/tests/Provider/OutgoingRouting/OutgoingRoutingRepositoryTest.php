<?php

namespace Tests\Provider\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\OutgoingRoutingDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class OutgoingRoutingRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_outgoing_routing_by_carrier();
    }

    public function it_finds_outgoing_routing_by_carrier()
    {
        /** @var OutgoingRoutingDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(OutgoingRouting::class);

        $result = $repository->findByCarrier(1);

        $this->assertIsArray($result);

        if (!empty($result)) {
            $this->assertInstanceOf(
                OutgoingRouting::class,
                $result[0]
            );
        }
    }
}
