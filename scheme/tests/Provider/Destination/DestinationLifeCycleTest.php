<?php

namespace Tests\Provider\Destination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;

class DestinationLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return DestinationDto
     */
    protected function createDto()
    {
        $destinationDto = new DestinationDto();
        $destinationDto
            ->setPrefix('+34')
            ->setNameEn('testName')
            ->setNameEs('testNombre')
            ->setTpDestinationId(1)
            ->setBrandId(1);

        return $destinationDto;
    }

    /**
     * @return Destination
     */
    protected function addDestination()
    {
        $destinationDto = $this->createDto();

        /** @var Destination $destination */
        $destination = $this->entityTools
            ->persistDto($destinationDto, null, true);

        return $destination;
    }


    protected function updateDestination()
    {
        $destinationRepository = $this->em
            ->getRepository(Destination::class);

        $destination = $destinationRepository->find(1);

        /** @var DestinationDto $destinationDto */
        $destinationDto = $this->entityTools->entityToDto($destination);

        $destinationDto
            ->setPrefix('+35');

        return $this
            ->entityTools
            ->persistDto($destinationDto, $destination, true);
    }

    protected function removeDestination()
    {
        $destinationRepository = $this->em
            ->getRepository(Destination::class);

        $destination = $destinationRepository->find(1);

        $this
            ->entityTools
            ->remove($destination);
    }

    /**
     * @test
     */
    public function it_persists_destinations()
    {
        $destination = $this->em
            ->getRepository(Destination::class);
        $fixtureDestinations = $destination->findAll();

        $this->addDestination();

        $brands = $destination->findAll();
        $this->assertCount(count($fixtureDestinations) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addDestination();
        $this->assetChangedEntities([
            Destination::class,
            TpDestination::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDestination();
        $this->assetChangedEntities([
            Destination::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDestination();
        $this->assetChangedEntities([
            Destination::class
        ]);
    }

    //////////////////////////////////////////
    ///
    //////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_destination_has_tpDestination()
    {
        $destination = $this->em
            ->getRepository(TpDestination::class);
        $tpDestinations = $destination->findAll();

        $this->addDestination();

        $brands = $destination->findAll();
        $this->assertCount(count($tpDestinations) + 1, $brands);
    }
}
