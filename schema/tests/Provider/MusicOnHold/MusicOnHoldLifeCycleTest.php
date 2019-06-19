<?php

namespace Tests\Provider\MusicOnHold;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto;

class MusicOnHoldLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return MusicOnHoldDto
     */
    protected function createDto()
    {
        $musicOnHoldDto = new MusicOnHoldDto();
        $musicOnHoldDto
            ->setName('testSomeMusicOnHold')
            ->setStatus('error')
            ->setCompanyId(1);

        return $musicOnHoldDto;
    }

    /**
     * @return MusicOnHold
     */
    protected function addMusicOnHold()
    {
        $musicOnHoldDto = $this->createDto();

        /** @var MusicOnHold $musicOnHold */
        $musicOnHold = $this->entityTools
            ->persistDto($musicOnHoldDto, null, true);

        return $musicOnHold;
    }

    protected function updateMusicOnHold()
    {
        $musicOnHoldRepository = $this->em
            ->getRepository(MusicOnHold::class);

        $musicOnHold = $musicOnHoldRepository->find(1);

        /** @var MusicOnHoldDto $musicOnHoldDto */
        $musicOnHoldDto = $this->entityTools->entityToDto($musicOnHold);

        $musicOnHoldDto
            ->setName('updatedName');

        return $this
            ->entityTools
            ->persistDto($musicOnHoldDto, $musicOnHold, true);
    }

    protected function removeMusicOnHold()
    {
        $musicOnHoldRepository = $this->em
            ->getRepository(MusicOnHold::class);

        $musicOnHold = $musicOnHoldRepository->find(1);

        $this
            ->entityTools
            ->remove($musicOnHold);
    }

    /**
     * @test
     */
    public function it_persists_musicOnHolds()
    {
        $musicOnHold = $this->em
            ->getRepository(MusicOnHold::class);
        $fixtureMusicOnHolds = $musicOnHold->findAll();
        $this->assertCount(2, $fixtureMusicOnHolds);

        $this->addMusicOnHold();

        $brands = $musicOnHold->findAll();
        $this->assertCount(3, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addMusicOnHold();
        $this->assetChangedEntities([
            MusicOnHold::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateMusicOnHold();
        $this->assetChangedEntities([
            MusicOnHold::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeMusicOnHold();
        $this->assetChangedEntities([
            MusicOnHold::class
        ]);
    }
}
