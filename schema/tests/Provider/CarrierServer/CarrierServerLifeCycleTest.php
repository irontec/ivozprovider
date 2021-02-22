<?php

namespace Tests\Provider\CarrierServer;

use Ivoz\Provider\Domain\Model\Changelog\Changelog;
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
        $carrierServerRepository = $this->em
            ->getRepository(CarrierServer::class);
        $fixtureCarrierServers = $carrierServerRepository->findAll();

        $carrierServer = $this->addCarrierServer();

        $carrierServers = $carrierServerRepository->findAll();
        $this->assertCount(count($fixtureCarrierServers) + 1, $carrierServers);

        //////////////////////////////////
        ///
        //////////////////////////////////
        $this->added_carrierServer_triggers_lifecycle_services();
        $this->added_carrierServer_has_trunksLcrGateway();
        $this->added_carrierServer_has_trunksLcrRuleTarget(
            $carrierServer
        );
    }

    protected function added_carrierServer_triggers_lifecycle_services()
    {
        $this->assetChangedEntities(
            [
                CarrierServer::class,
                TrunksLcrGateway::class,
                TrunksLcrRuleTarget::class
            ]
        );
    }

    protected function added_carrierServer_has_trunksLcrGateway()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrGateway::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'lcr_id' => '1',
            'gw_name' => 'b1c1s3',
            'hostname' => '127.1.1.1',
            'port' => 5060,
            'uri_scheme' => 1,
            'transport' => 1,
            'carrierServerId' => 3,
            'id' => 3
        ];

        $this->assertEquals(
            $expectedSubset,
            $diff
        );
    }

    protected function added_carrierServer_has_trunksLcrRuleTarget(
        CarrierServer $carrierServer
    ) {
        $lcrRules = [];
        $outgoingRoutings = $carrierServer->getCarrier()->getOutgoingRoutings();
        foreach ($outgoingRoutings as $outgoingRouting) {
            $lcrRules = $outgoingRouting->getLcrRules();
            foreach ($lcrRules as $lcrRule) {
                $lcrRules[$lcrRule->getId()] = $lcrRule;
            }
        }
        $lcrRuleNumber = count(array_keys($lcrRules));

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksLcrRuleTarget::class
        );

        $newEntities = [];
        foreach ($changelogEntries as $changelogEntry) {
            $data = $changelogEntry->getData();
            if (!array_key_exists('id', $data)) {
                continue;
            }
            $newEntities[] = $changelogEntry;
        }

        $this->assertCount($lcrRuleNumber, $newEntities);
        $changelog = $newEntities[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'lcr_id' => 1,
            'priority' => 1,
            'weight' => 4,
            'ruleId' => 2,
            'gwId' => 3,
            'outgoingRoutingId' => 1,
            'id' => 5
        ];

        $this->assertEquals(
            $expectedSubset,
            $diff
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
            CarrierServer::class,
            TrunksLcrRuleTarget::class
        ]);
    }
}
