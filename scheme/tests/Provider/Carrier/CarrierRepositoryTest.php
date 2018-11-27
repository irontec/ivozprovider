<?php

namespace Tests\Provider\Carrier;

use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\CarrierDoctrineRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class CarrierRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_finds_carrier_ids_group_by_brand()
    {
        /** @var CarrierDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->getCarrierIdsGroupByBrand();

        $this->assertNotEmpty($result);
    }
}