<?php

namespace Tests\Provider\DdiProvider;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

class DdiProviderRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_ids_by_brand_admin();
        $this->it_finds_ids_by_brand_and_proxyTrunk();
        $this->it_finds_ids_by_proxyTrunk();
    }

    public function its_instantiable()
    {
        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

        $this->assertInstanceOf(
            DdiProviderRepository::class,
            $repository
        );
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

        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

        $result = $repository->getDdiProviderIdsByBrandAdmin(
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

        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

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

        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

        $result = $repository->findByProxyTrunks(
            $proxyTrunk
        );

        $this->assertNotEmpty(
            $result
        );
    }
}
