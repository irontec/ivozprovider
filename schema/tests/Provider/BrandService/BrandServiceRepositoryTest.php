<?php

namespace Tests\Provider\BrandService;

use Ivoz\Provider\Domain\Model\BrandService\BrandServiceRepository;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;

class BrandServiceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->its_finds_by_brandId();
        $this->its_finds_services_by_brandId();
    }

    public function its_instantiable()
    {
        /** @var BrandServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(BrandService::class);

        $this->assertInstanceOf(
            BrandServiceRepository::class,
            $repository
        );
    }

    public function its_finds_by_brandId()
    {
        /** @var BrandServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(BrandService::class);

        $results = $repository->findByBrandId(1);

        $this->assertIsArray(
            $results
        );

        $this->assertInstanceOf(
            BrandServiceInterface::class,
            $results[0]
        );
    }


    public function its_finds_services_by_brandId()
    {
        /** @var BrandServiceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(BrandService::class);

        $results = $repository->getServiceIdsByBrand(1);

        $this->assertIsArray(
            $results
        );

        $this->assertIsInt(
            $results[0]
        );
    }
}
