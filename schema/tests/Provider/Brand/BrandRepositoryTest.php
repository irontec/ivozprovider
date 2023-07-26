<?php

namespace Tests\Provider\Brand;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class BrandRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_one_by_domain();
        $this->it_counts_brands();
    }

    public function it_finds_one_by_domain()
    {
        /** @var BrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Brand::class);

        $company = $repository->findOneByDomain('sip.irontec.com');

        $this->assertInstanceOf(
            Brand::class,
            $company
        );
    }

    public function it_counts_brands()
    {
        /** @var BrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Brand::class);

        $count = $repository->count([]);

        $this->assertEquals(
            2,
            $count
        );
    }

    public function it_finds_latest_brands()
    {
        /** @var BrandRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Brand::class);

        $brands = $repository->getLatest(2);

        $this->assertInstanceOf(
            Brand::class,
            $brands[0]
        );
    }
}
