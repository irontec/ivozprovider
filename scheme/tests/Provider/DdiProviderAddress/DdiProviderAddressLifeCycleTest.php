<?php

namespace Tests\Provider\DdiProviderAddress;

use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddress;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;

class DdiProviderAddressLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return DdiProviderAddressDto
     */
    protected function createDto()
    {
        $ddiProviderAddressDto = new DdiProviderAddressDto();
        $ddiProviderAddressDto
            ->setIp('127.1.1.1')
            ->setDescription('Description')
            ->setTrunksAddressId(1)
            ->setDdiProviderId(1);

        return $ddiProviderAddressDto;
    }

    /**
     * @return DdiProviderAddress
     */
    protected function addDdiProviderAddress()
    {
        $ddiProviderAddressDto = $this->createDto();

        /** @var DdiProviderAddress $ddiProviderAddress */
        $ddiProviderAddress = $this->entityTools
            ->persistDto($ddiProviderAddressDto, null, true);

        return $ddiProviderAddress;
    }

    protected function updateDdiProviderAddress()
    {
        $ddiProviderAddressRepository = $this->em
            ->getRepository(DdiProviderAddress::class);

        $ddiProviderAddress = $ddiProviderAddressRepository->find(1);

        /** @var DdiProviderAddressDto $ddiProviderAddressDto */
        $ddiProviderAddressDto = $this->entityTools->entityToDto($ddiProviderAddress);

        $ddiProviderAddressDto
            ->setIp('127.1.1.2');

        return $this
            ->entityTools
            ->persistDto($ddiProviderAddressDto, $ddiProviderAddress, true);
    }

    protected function removeDdiProviderAddress()
    {
        $ddiProviderAddressRepository = $this->em
            ->getRepository(DdiProviderAddress::class);

        $ddiProviderAddress = $ddiProviderAddressRepository->find(1);

        $this
            ->entityTools
            ->remove($ddiProviderAddress);
    }

    /**
     * @test
     */
    public function it_persists_ddiProviderAddresss()
    {
        $ddiProviderAddress = $this->em
            ->getRepository(DdiProviderAddress::class);
        $fixtureDdiProviderAddresss = $ddiProviderAddress->findAll();
        $this->assertCount(1, $fixtureDdiProviderAddresss);

        $this->addDdiProviderAddress();

        $brands = $ddiProviderAddress->findAll();
        $this->assertCount(2, $brands);
    }

    /**
     * @test
     */
    public function added_ddiProviderAddress_triggers_lifecycle_services()
    {
        $this->addDdiProviderAddress();
        $changedEntities = $this->getChangedEntities();

        $this->assertEquals(
            $changedEntities,
            [
                DdiProviderAddress::class,
                TrunksAddress::class,
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDdiProviderAddress();
        $this->assetChangedEntities([
            DdiProviderAddress::class,
            TrunksAddress::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDdiProviderAddress();
        $this->assetChangedEntities([
            DdiProviderAddress::class
        ]);
    }

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_ddiProviderAddress_has_trunksAddress()
    {
        $this->addDdiProviderAddress();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksAddress::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'grp' => 1,
            'ip_addr' => '127.1.1.1',
            'mask' => 32,
            'ddiProviderAddressId' => 2,
            'id' => 1,
            'port' => 0
        ];

        $this->assertEquals(
            $expectedSubset,
            $diff
        );
    }
}
