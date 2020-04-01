<?php

namespace Tests\Provider\Carrier;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
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
    public function test_runner()
    {
        $this->it_finds_carrier_ids_group_by_brand();
    }

    public function it_finds_carrier_ids_group_by_brand()
    {
        /** @var CarrierDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->getCarrierIdsGroupByBrand();

        $this->assertNotEmpty($result);
    }

    public function it_finds_ids_by_brand_admin()
    {
        /** @var AdministratorRepository $adminRepository */
        $adminRepository = $this
            ->em
            ->getRepository(Administrator::class);

        $brandAdmin = $adminRepository->findBrandAdminByUsername(
            'test_brand_admin'
        );

        /** @var CarrierDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->getCarrierIdsByBrandAdmin(
            $brandAdmin
        );

        $this->assertNotEmpty(
            $result
        );
    }
}
