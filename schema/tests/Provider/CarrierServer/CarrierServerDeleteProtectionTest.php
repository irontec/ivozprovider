<?php

namespace Tests\Provider\CarrierServer;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

class CarrierServerDeleteProtectionTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_can_delete_server_from_unused_carrier();
        $this->it_cannot_delete_last_server_from_used_carrier();
    }

    public function it_can_delete_server_from_unused_carrier()
    {
        $carrierDto = new CarrierDto();
        $carrierDto
            ->setName('Test Unused Carrier')
            ->setDescription('Test carrier for deletion test')
            ->setBrandId(1)
            ->setProxyTrunkId(1);

        /** @var Carrier $unusedCarrier */
        $unusedCarrier = $this->entityTools
            ->persistDto($carrierDto, null, true);

        $carrierServerDto = new CarrierServerDto();
        $carrierServerDto
            ->setHostname('unused-carrier.example.com')
            ->setPort(5060)
            ->setUriScheme(1)
            ->setTransport(1)
            ->setSipProxy('unused-carrier.example.com')
            ->setCarrierId($unusedCarrier->getId())
            ->setBrandId(1);

        /** @var CarrierServer $carrierServer */
        $carrierServer = $this->entityTools
            ->persistDto($carrierServerDto, null, true);

        $this->entityTools->remove($carrierServer);

        $this->addToAssertionCount(1);
    }

    public function it_cannot_delete_last_server_from_used_carrier()
    {
        $carrierDto = new CarrierDto();
        $carrierDto
            ->setName('Test Used Carrier')
            ->setDescription('Test carrier used in routes')
            ->setBrandId(1)
            ->setProxyTrunkId(1);

        /** @var Carrier $usedCarrier */
        $usedCarrier = $this->entityTools
            ->persistDto($carrierDto, null, true);

        $outgoingRoutingDto = new OutgoingRoutingDto();
        $outgoingRoutingDto
            ->setType('pattern')
            ->setPriority(999)
            ->setWeight(1)
            ->setBrandId(1)
            ->setRoutingMode('static')
            ->setCarrierId($usedCarrier->getId());

        /** @var OutgoingRouting $outgoingRouting */
        $outgoingRouting = $this->entityTools
            ->persistDto($outgoingRoutingDto, null, true);

        $carrierServerDto = new CarrierServerDto();
        $carrierServerDto
            ->setHostname('used-carrier.example.com')
            ->setPort(5060)
            ->setUriScheme(1)
            ->setTransport(1)
            ->setSipProxy('used-carrier.example.com')
            ->setCarrierId($usedCarrier->getId())
            ->setBrandId(1);

        /** @var CarrierServer $carrierServer */
        $carrierServer = $this->entityTools
            ->persistDto($carrierServerDto, null, true);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage(
            'Cannot delete the last CarrierServer from a Carrier that is being used in outgoing routes'
        );

        $this->entityTools->remove($carrierServer);
    }
}
