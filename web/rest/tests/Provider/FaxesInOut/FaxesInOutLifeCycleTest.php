<?php

namespace Tests\Provider\FaxesInOut;

use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class FaxesInOutLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return FaxesInOut
     */
    protected function addFaxInOut()
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
            ->entityPersister
            ->persistDto($extensionDto, null, true);
    }

    /**
     * @test
     */
    public function it_persists_faxInOuts()
    {
        $extensionRepository = $this->em
            ->getRepository(FaxesInOut::class);

        $fixtureFaxesInOuts = $extensionRepository->findAll();
        $this->assertCount(1, $fixtureFaxesInOuts);

        $this->addFaxInOut();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureFaxesInOuts) + 1,
            $extensions
        );
    }
}