<?php

namespace Tests\Provider\ProxyTrunksRelBrand;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;

class ProxyTrunksRelBrandRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_trunks_by_brand_admin();
    }

    private function its_instantiable()
    {
        /** @var ProxyTrunksRelBrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ProxyTrunksRelBrand::class);

        $this->assertInstanceOf(
            ProxyTrunksRelBrandRepository::class,
            $repository
        );
    }

    private function it_finds_trunks_by_brand_admin()
    {
        /** @var AdministratorRepository $repository */
        $adminRepository = $this
            ->em
            ->getRepository(Administrator::class);

        $admin = $adminRepository->findOneBy([
            'username' => 'test_brand_admin'
        ]);

        /** @var ProxyTrunksRelBrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ProxyTrunksRelBrand::class);

        $trunksIds = $repository->getTrunkIdsByBrandAdmin(
            $admin
        );

        $this->assertNotEmpty(
            $trunksIds
        );

        $this->assertIsInt(
            $trunksIds[0]
        );
    }
}
