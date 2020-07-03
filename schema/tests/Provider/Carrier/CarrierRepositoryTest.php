<?php

namespace Tests\Provider\Carrier;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
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
        $this->it_finds_carrier_ids_with_calculatecost_group_by_brand();
        $this->it_finds_ids_by_brand_admin();
        $this->it_finds_ids_by_brand_and_proxyTrunk();
        $this->it_finds_ids_by_proxyTrunk();
    }

    public function it_finds_carrier_ids_with_calculatecost_group_by_brand()
    {
        /** @var CarrierDoctrineRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->getCarrierIdsWithCalculatecostGroupByBrand();

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

    public function it_finds_ids_by_brand_and_proxyTrunk()
    {
        /** @var BrandRepository $brandRepository */
        $brandRepository = $this
            ->em
            ->getRepository(Brand::class);

        $brand = $brandRepository->find(1);

        /** @var ProxyTrunkRepository $repository */
        $proxyTrunkRepository = $this
            ->em
            ->getRepository(ProxyTrunk::class);

        $proxyTrunk = $proxyTrunkRepository->find(1);

        /** @var ProxyTrunkRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->findByBrandAndProxyTrunks(
            $brand,
            $proxyTrunk
        );

        $this->assertNotEmpty(
            $result
        );
    }

    public function it_finds_ids_by_proxyTrunk()
    {
        /** @var ProxyTrunkRepository $repository */
        $proxyTrunkRepository = $this
            ->em
            ->getRepository(ProxyTrunk::class);

        $proxyTrunk = $proxyTrunkRepository->find(1);

        /** @var ProxyTrunkRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Carrier::class);

        $result = $repository->findByProxyTrunks(
            $proxyTrunk
        );

        $this->assertNotEmpty(
            $result
        );
    }
}
