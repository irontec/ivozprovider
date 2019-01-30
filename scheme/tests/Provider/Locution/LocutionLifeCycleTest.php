<?php

namespace Tests\Provider\Locution;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;

class LocutionLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return LocutionDto
     */
    protected function createDto()
    {
        $locutionDto = new LocutionDto();
        $locutionDto
            ->setName('testSomeLocution')
            ->setStatus('error')
            ->setCompanyId(1);

        return $locutionDto;
    }

    /**
     * @return Locution
     */
    protected function addLocution()
    {
        $locutionDto = $this->createDto();

        /** @var Locution $locution */
        $locution = $this->entityTools
            ->persistDto($locutionDto, null, true);

        return $locution;
    }

    protected function updateLocution()
    {
        $locutionRepository = $this->em
            ->getRepository(Locution::class);

        $locution = $locutionRepository->find(1);

        /** @var LocutionDto $locutionDto */
        $locutionDto = $this->entityTools->entityToDto($locution);

        $locutionDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($locutionDto, $locution, true);
    }

    protected function removeLocution()
    {
        $locutionRepository = $this->em
            ->getRepository(Locution::class);

        $locution = $locutionRepository->find(1);

        $this
            ->entityTools
            ->remove($locution);
    }

    /**
     * @test
     */
    public function it_persists_locutions()
    {
        $locution = $this->em
            ->getRepository(Locution::class);
        $fixtureLocutions = $locution->findAll();
        $this->assertCount(1, $fixtureLocutions);

        $this->addLocution();

        $brands = $locution->findAll();
        $this->assertCount(2, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addLocution();
        $this->assetChangedEntities([
            Locution::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateLocution();
        $this->assetChangedEntities([
            Locution::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeLocution();
        $this->assetChangedEntities([
            Locution::class
        ]);
    }
}
