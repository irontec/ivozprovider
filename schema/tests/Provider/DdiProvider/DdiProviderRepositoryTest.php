<?php

namespace Tests\Provider\DdiProvider;

use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
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
            ->getRepository(DdiProviderRepository::class);

        $result = $repository->getDdiProviderIdsByBrandAdmin(
            $brandAdmin
        );

        $this->assertNotEmpty(
            $result
        );
    }
}
