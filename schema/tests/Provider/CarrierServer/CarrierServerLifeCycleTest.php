<?php

namespace Tests\Provider\CarrierServer;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;

class CarrierServerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return CarrierServerDto
     */
    protected function createDto()
    {
        $carrierServerDto = new CarrierServerDto();
        $carrierServerDto
            ->setHostname('127.1.1.1')
            ->setPort(5060)
            ->setUriScheme(1)
            ->setTransport(1)
            ->setSendPAI(false)
            ->setSendRPID(false)
            ->setSipProxy('127.1.1.1')
            ->setFromUser('')
            ->setFromDomain('')
            ->setCarrierId(1)
            ->setBrandId(1);

        return $carrierServerDto;
    }

    /**
     * @return CarrierServer
     */
    protected function addCarrierServer()
    {
        $carrierServerDto = $this->createDto();

        /** @var CarrierServer $carrierServer */
        $carrierServer = $this->entityTools
            ->persistDto($carrierServerDto, null, true);

        return $carrierServer;
    }

    protected function updateCarrierServer()
    {
        $carrierServerRepository = $this->em
            ->getRepository(CarrierServer::class);

        $carrierServer = $carrierServerRepository->find(
            1
        );

        /** @var CarrierServerDto $carrierServerDto */
        $carrierServerDto = $this->entityTools->entityToDto($carrierServer);

        $carrierServerDto
            ->setSipProxy('127.1.1.2');

        return $this
            ->entityTools
            ->persistDto($carrierServerDto, $carrierServer, true);
    }

    protected function removeCarrierServer()
    {
        $carrierServerRepository = $this->em
            ->getRepository(CarrierServer::class);

        $carrierServer = $carrierServerRepository->find(1);

        $this
            ->entityTools
            ->remove($carrierServer);
    }

    /**
     * @test
     */
    public function it_persists_carrierServers()
    {
        $carrierServer = $this->em
            ->getRepository(CarrierServer::class);
        $fixtureCarrierServers = $carrierServer->findAll();

        $this->addCarrierServer();

        $brands = $carrierServer->findAll();
        $this->assertCount(count($fixtureCarrierServers) + 1, $brands);
    }

    /**
     * @test
     */
    public function added_carrierServer_triggers_lifecycle_services()
    {
        $this->addCarrierServer();
        $this->assetChangedEntities(
            [
                CarrierServer::class,
                TrunksLcrGateway::class,
                TrunksLcrRuleTarget::class
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateCarrierServer();
        $this->assetChangedEntities([
            CarrierServer::class,
            TrunksLcrGateway::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeCarrierServer();
        $this->assetChangedEntities([
            CarrierServer::class
        ]);
    }

    ////////////////////////////////////////////////////////
    ///
    ////////////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_carrierServer_has_trunksLcrGateway()
    {
        $this->addCarrierServer();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrGateway::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'lcr_id' => '1',
            'gw_name' => 'b1c1s2',
            'hostname' => '127.1.1.1',
            'port' => 5060,
            'uri_scheme' => 1,
            'transport' => 1,
            'carrierServerId' => 2,
            'id' => 2
        ];

        $this->assertEquals(
            $expectedSubset,
            $diff
        );
    }

    /**
     * @test
     * @deprecated
     */
    public function added_carrierServer_has_trunksLcrRuleTarget()
    {
        $this->addCarrierServer();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrRuleTarget::class
        );

        $this->assertCount(2, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'lcr_id' => '1',
            'priority' => 1,
            'weight' => 1,
            'ruleId' => 2,
            'gwId' => 2,
            'outgoingRoutingId' => 1,
            'id' => 3
        ];

        $this->assertEquals(//)assertArraySubset(
            $expectedSubset,
            $diff
        );
    }
}
