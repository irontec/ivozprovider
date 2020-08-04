<?php

namespace Tests\Provider\DestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpRate\TpRate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;

class DestinationRateLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return DestinationRateDto
     */
    protected function createDto()
    {
        $destinationRateDto = new DestinationRateDto();
        $destinationRateDto
            ->setCost('10.3')
            ->setConnectFee('0.01')
            ->setRateIncrement('1')
            ->setGroupIntervalStart('0')
            ->setDestinationId(2)
            ->setDestinationRateGroupId(1);

        return $destinationRateDto;
    }

    /**
     * @return DestinationRate
     */
    protected function addDestinationRate()
    {
        $destinationRateDto = $this->createDto();

        /** @var DestinationRate $destinationRate */
        $destinationRate = $this->entityTools
            ->persistDto($destinationRateDto, null, true);

        return $destinationRate;
    }

    protected function updateDestinationRate($id = 1)
    {
        $destinationRateRepository = $this->em
            ->getRepository(DestinationRate::class);
        $destinationRate = $destinationRateRepository->find($id);

        /** @var DestinationRateDto $destinationRateDto */
        $destinationRateDto = $this->entityTools->entityToDto($destinationRate);

        $destinationRateDto
            ->setCost('10.1')
            ->setDestinationRateGroupId(2);

        return $this
            ->entityTools
            ->persistDto($destinationRateDto, $destinationRate, true);
    }

    protected function removeDestinationRate()
    {
        $destinationRateRepository = $this->em
            ->getRepository(DestinationRate::class);

        $destinationRate = $destinationRateRepository->find(1);

        $this
            ->entityTools
            ->remove($destinationRate);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addDestinationRate();
        $this->assetChangedEntities([
            DestinationRate::class,
            TpRate::class,
            TpDestinationRate::class,
        ]);
    }

    /**
     * @test
     */
    public function it_persists_destinationRates()
    {
        $destinationRate = $this->em
            ->getRepository(DestinationRate::class);
        $fixtureDestinationRates = $destinationRate->findAll();

        $this->addDestinationRate();

        $brands = $destinationRate->findAll();
        $this->assertCount(count($fixtureDestinationRates) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_creates_tp_rate()
    {
        $this->addDestinationRate();

        $changelogEntries = $this->getChangelogByClass(
            TpRate::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertChangedSubset(
            $changelog,
            [
                'tpid' => 'b1',
                'tag' => 'b1rt2',
                'connect_fee' => 0.01,
                'rate' => 10.300000000000001,
                'rate_unit' => '60s',
                'rate_increment' => '1s',
                'group_interval_start' => '0s',
                'destinationRateId' => 2,
                'id' => 1,
            ],
            ['created_at']
        );
    }

    /**
     * @test
     */
    public function it_creates_tp_destination_rate()
    {
        $this->addDestinationRate();

        $changelogEntries = $this->getChangelogByClass(
            TpDestinationRate::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertChangedSubset(
            $changelog,
            [
                'tpid' => 'b1',
                'tag' => 'b1dr1',
                'destinations_tag' => 'b1dst2',
                'rates_tag' => 'b1rt2',
                'rounding_method' => '*up',
                'rounding_decimals' => 4,
                'max_cost' => 0.0,
                'max_cost_strategy' => '',
                'destinationRateId' => 2,
                'id' => 1,
            ],
            ['created_at']
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDestinationRate();
        $this->assetChangedEntities([
            DestinationRate::class,
            TpRate::class,
            TpDestinationRate::class,
        ]);
    }

    /**
     * @test
     */
    public function it_updates_tp_rate()
    {
        $dr = $this->addDestinationRate();
        $this->resetChangelog();

        $this->updateDestinationRate(
            $dr->getId()
        );

        $changelogEntries = $this->getChangelogByClass(
            TpRate::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'rate' => 10.1,
            ]
        );
    }

    /**
     * @test
     */
    public function updates_tp_destination_rate()
    {
        $dr = $this->addDestinationRate();
        $this->resetChangelog();

        $this->updateDestinationRate(
            $dr->getId()
        );

        $changelogEntries = $this->getChangelogByClass(
            TpDestinationRate::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'tag' => 'b1dr2'
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDestinationRate();
        $this->assetChangedEntities([
            DestinationRate::class
        ]);
    }
}
