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
        $ddiProviderRegistrationDto = $this->createDto();

        /** @var DestinationRate $ddiProviderRegistration */
        $ddiProviderRegistration = $this->entityTools
            ->persistDto($ddiProviderRegistrationDto, null, true);

        return $ddiProviderRegistration;
    }

    protected function updateDestinationRate()
    {
        $destinationRateRepository = $this->em
            ->getRepository(DestinationRate::class);
        $destinationRate = $destinationRateRepository->find(1);

        /** @var DestinationRateDto $destinationRateDto */
        $destinationRateDto = $this->entityTools->entityToDto($destinationRate);

        $destinationRateDto
            ->setCost('10.1');

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
    public function it_persists_destinationRates()
    {
        $ddiProviderRegistration = $this->em
            ->getRepository(DestinationRate::class);
        $fixtureDestinationRates = $ddiProviderRegistration->findAll();

        $this->addDestinationRate();

        $brands = $ddiProviderRegistration->findAll();
        $this->assertCount(count($fixtureDestinationRates) + 1, $brands);
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
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDestinationRate();
        $this->assetChangedEntities([
            DestinationRate::class
        ]);
    }

    ////////////////////////////////////////////////
    ///
    ////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_destinationRates_has_tpRates()
    {
        $destinationRepository = $this->em
            ->getRepository(TpRate::class);

        $tpDestinations = $destinationRepository->findAll();
        $this->assertCount(0, $tpDestinations);

        $this->addDestinationRate();

        $brands = $destinationRepository->findAll();
        $this->assertCount(1, $brands);
    }

    /**
     * @test
     * @deprecated
     */
    public function added_destinationRates_has_tpDestinationRate()
    {
        $destinationRepository = $this->em
            ->getRepository(TpDestinationRate::class);

        $tpDestinations = $destinationRepository->findAll();
        $this->assertCount(0, $tpDestinations);

        $this->addDestinationRate();

        $brands = $destinationRepository->findAll();
        $this->assertCount(1, $brands);
    }
}
