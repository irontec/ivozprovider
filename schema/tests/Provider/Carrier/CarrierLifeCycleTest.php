<?php

namespace Tests\Provider\Carrier;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStat;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;

class CarrierLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return CarrierDto
     */
    protected function createDto()
    {
        $carrierDto = new CarrierDto();
        $carrierDto
            ->setName('testCarrier')
            ->setProxyTrunkId(1)
            ->setBrandId(1);

        return $carrierDto;
    }

    /**
     * @return Carrier
     */
    protected function addCarrier()
    {
        $carrierDto = $this->createDto();

        /** @var Carrier $carrier */
        $carrier = $this->entityTools
            ->persistDto($carrierDto, null, true);

        return $carrier;
    }

    protected function updateCarrier()
    {
        $carrierRepository = $this->em
            ->getRepository(Carrier::class);

        $carrier = $carrierRepository->find(1);

        /** @var CarrierDto $carrierDto */
        $carrierDto = $this->entityTools->entityToDto($carrier);

        $carrierDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($carrierDto, $carrier, true);
    }

    protected function removeCarrier()
    {
        $carrierRepository = $this->em
            ->getRepository(Carrier::class);

        $carrier = $carrierRepository->find(1);

        $this
            ->entityTools
            ->remove($carrier);
    }

    /**
     * @test
     */
    public function it_persists_carriers()
    {
        $carrier = $this->em
            ->getRepository(Carrier::class);
        $fixtureCarriers = $carrier->findAll();
        $this->addCarrier();

        $brands = $carrier->findAll();
        $this->assertCount(count($fixtureCarriers) +1, $brands);

        ////////////////
        ///
        ////////////////

        $this->it_triggers_lifecycle_services();
        $this->added_carrier_has_tpCdrStats();
        $this->added_carrier_has_tpAccountAction();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities(
            [
                Carrier::class,
                TpAccountAction::class,
                TpCdrStat::class
            ]
        );
    }

    protected function added_carrier_has_tpCdrStats()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TpCdrStat::class
        );

        $this->assertCount(2, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        //Skip empty default values
        $diff = array_filter($diff, function ($value) {
            return !empty($value);
        });
        $this->assertSubset(
            [
                'tpid' => 'b1',
                'tag' => 'cr3',
                'metrics' => 'ACD',
                'subjects' => 'cr3',
                'carrierId' => 3,
                'id' => 1
            ],
            $diff
        );

        $this->assertEquals(
            array_keys($diff),
            [
                'tpid',
                'tag',
                'metrics',
                'subjects',
                'created_at',
                'carrierId',
                'id'
            ]
        );
    }

    protected function added_carrier_has_tpAccountAction()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TpAccountAction::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        //Skip empty default values
        $diff = array_filter($diff, function ($value) {
            return !empty($value);
        });

        $expectedSubset = [
            'tpid' => 'b1',
            'loadid' => 'DATABASE',
            'tenant' => 'b1',
            'account' => 'cr3',
            'allow_negative' => 1,
            'carrierId' => 3,
            'id' => 3
        ];

        $this->assertSubset(
            $expectedSubset,
            $diff
        );

        $this->assertEquals(
            count(array_keys($diff)),
            count(
                array_merge(
                    array_keys($expectedSubset),
                    ['created_at']
                )
            )
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateCarrier();
        $this->assetChangedEntities([
            Carrier::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeCarrier();
        $this->assetChangedEntities([
            \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile::class, //orm soft delete
            RatingProfile::class, //orm soft delete
            Carrier::class
        ]);
    }
}
