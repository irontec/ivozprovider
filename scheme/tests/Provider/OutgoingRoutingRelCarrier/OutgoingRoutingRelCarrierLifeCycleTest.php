<?php

namespace Tests\Provider\OutgoingRoutingRelCarrier;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;

class OutgoingRoutingRelCarrierLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return OutgoingRoutingRelCarrierDto
     */
    protected function createDto()
    {
        $outgoingRoutingRelCarrierDto = new OutgoingRoutingRelCarrierDto();
        $outgoingRoutingRelCarrierDto
            ->setOutgoingRoutingId(1)
            ->setCarrierId(1)
            ->setTpRatingProfiles([]);

        return $outgoingRoutingRelCarrierDto;
    }

    /**
     * @return OutgoingRoutingRelCarrier
     */
    protected function addOutgoingRoutingRelCarrier()
    {
        $outgoingRoutingRelCarrierDto = $this->createDto();

        /** @var OutgoingRoutingRelCarrier $outgoingRoutingRelCarrier */
        $outgoingRoutingRelCarrier = $this->entityTools
            ->persistDto($outgoingRoutingRelCarrierDto, null, true);

        return $outgoingRoutingRelCarrier;
    }

    protected function updateOutgoingRoutingRelCarrier()
    {
        $this->addOutgoingRoutingRelCarrier();
        $this->resetChangelog();

        $outgoingRoutingRelCarrierRepository = $this->em
            ->getRepository(OutgoingRoutingRelCarrier::class);

        $outgoingRoutingRelCarrier = $outgoingRoutingRelCarrierRepository->find(1);

        /** @var OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrierDto */
        $outgoingRoutingRelCarrierDto = $this->entityTools->entityToDto($outgoingRoutingRelCarrier);

        $outgoingRoutingRelCarrierDto
            ->setOutgoingRoutingId(2);

        return $this
            ->entityTools
            ->persistDto($outgoingRoutingRelCarrierDto, $outgoingRoutingRelCarrier, true);
    }

    protected function removeOutgoingRoutingRelCarrier()
    {
        $this->addOutgoingRoutingRelCarrier();
        $this->resetChangelog();

        $outgoingRoutingRelCarrierRepository = $this->em
            ->getRepository(OutgoingRoutingRelCarrier::class);

        $outgoingRoutingRelCarrier = $outgoingRoutingRelCarrierRepository->find(1);

        $this
            ->entityTools
            ->remove($outgoingRoutingRelCarrier);
    }

    /**
     * @test
     */
    public function it_persists_outgoingRoutingRelCarriers()
    {
        $outgoingRoutingRelCarrier = $this->em
            ->getRepository(OutgoingRoutingRelCarrier::class);
        $fixtureOutgoingRoutingRelCarriers = $outgoingRoutingRelCarrier->findAll();

        $this->addOutgoingRoutingRelCarrier();

        $brands = $outgoingRoutingRelCarrier->findAll();
        $this->assertCount(count($fixtureOutgoingRoutingRelCarriers) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addOutgoingRoutingRelCarrier();
        $this->assetChangedEntities([
            OutgoingRoutingRelCarrier::class,
            TpRatingProfile::class,
        ]);
    }

    /**
     * @test
     * @expectedException \DomainException
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateOutgoingRoutingRelCarrier();
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeOutgoingRoutingRelCarrier();
        $this->assetChangedEntities([
            TpRatingProfile::class, // orm soft delete
            OutgoingRoutingRelCarrier::class,
        ]);
    }
}
