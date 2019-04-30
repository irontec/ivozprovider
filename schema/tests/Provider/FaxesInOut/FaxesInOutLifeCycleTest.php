<?php

namespace Tests\Provider\FaxesInOut;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class FaxesInOutLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function addFaxesInOut()
    {
        $extensionDto = new FaxesInOutDto();
        $extensionDto
            ->setCalldate(
                new \DateTime('2018-01-01', new \DateTimeZone('UTC'))
            )
            ->setFaxId(1)
            ->setSrc('34688888888')
            ->setDst('34688888881')
            ->setType('In')
            ->setStatus('error');

        /** @var FaxesInOut $extension */
        return $this
            ->entityTools
            ->persistDto($extensionDto, null, true);
    }

    protected function updateFaxesInOut()
    {
        $faxesInOutRepository = $this->em
            ->getRepository(FaxesInOut::class);

        $faxesInOut = $faxesInOutRepository->find(1);

        /** @var FaxesInOutDto $faxesInOutDto */
        $faxesInOutDto = $this->entityTools->entityToDto($faxesInOut);

        $faxesInOutDto
            ->setSrc('34688888889');

        return $this
            ->entityTools
            ->persistDto($faxesInOutDto, $faxesInOut, true);
    }

    protected function removeFaxesInOut()
    {
        $faxesInOutRepository = $this->em
            ->getRepository(FaxesInOut::class);

        $faxesInOut = $faxesInOutRepository->find(1);

        $this
            ->entityTools
            ->remove($faxesInOut);
    }

    /**
     * @test
     */
    public function it_persists_faxInOuts()
    {
        $extensionRepository = $this->em
            ->getRepository(FaxesInOut::class);

        $fixtureFaxesInOuts = $extensionRepository->findAll();

        $this->addFaxesInOut();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureFaxesInOuts) + 1,
            $extensions
        );
    }
    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addFaxesInOut();
        $this->assetChangedEntities([
            FaxesInOut::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateFaxesInOut();
        $this->assetChangedEntities([
            FaxesInOut::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeFaxesInOut();
        $this->assetChangedEntities([
            FaxesInOut::class
        ]);
    }
}
