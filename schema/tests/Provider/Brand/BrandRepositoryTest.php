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
}
