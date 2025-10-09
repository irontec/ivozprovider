<?php

namespace Tests\Provider\OutgoingRoutingRelCarrier;

use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\OutgoingRoutingRelCarrierDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class OutgoingRoutingRelCarrierRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_outgoing_routing_rel_carrier_by_carrier();
    }

    public function it_finds_outgoing_routing_rel_carrier_by_carrier()
    {
        /** @var OutgoingRoutingRelCarrierDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(OutgoingRoutingRelCarrier::class);

        $result = $repository->findByCarrier(1);

        $this->assertIsArray($result);

        if (!empty($result)) {
            $this->assertInstanceOf(
                OutgoingRoutingRelCarrier::class,
                $result[0]
            );
        }
    }
}
